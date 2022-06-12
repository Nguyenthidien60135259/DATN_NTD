<?php

namespace App\Exceptions;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        $msg = $exception->getMessage();
        if ($msg && $msg != 'Unauthenticated.') {
            if ($msg != 'The given data was invalid.' && $msg != 'CSRF token mismatch.' && $msg != 'Invalid method override "__CONSTRUCT"') {
                if (strpos($msg, 'method is not supported for this route. Supported methods') === false) {
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://api.telegram.org/' . env('TELEGRAM_BOT_ID', '') . '/sendMessage',
                        CURLOPT_USERAGENT => 'Viblo Exmaple POST',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_POSTFIELDS => http_build_query(array(
                            'chat_id' => env('TELEGRAM_CHAT_ID', ''),
                            'text' => '----NEW EVENZ---- '.$msg
                        ))
                    ));
                    $resp = curl_exec($curl);
                }
            }
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = Arr::get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login='admin.login';
                break;

            default:
                $login='login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
