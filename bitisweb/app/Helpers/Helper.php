<?php

function sale_calc($price,$discount){
    $result = ($price*$discount)/100;
    return $result;
}
if (!function_exists('env')) {
  function env()
  {
    //Xử lý hàm env()
  }
}

if (!function_exists('aFunctionName')) {
  function aFunctionName()
  {
     // Xử lý hàm aFunctionName()
  }
}
