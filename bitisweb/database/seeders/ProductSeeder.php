<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'code' => 'DSGH00300DOG',
            'name' => "Giày Thể Thao Bé Gái Biti's Hunter DSGH00300DOG (Đồng)",
            'desc' => '',
            'color_id' => '2',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '3',
            'product_tail_id' => '1'
        ]);
        DB::table('products')->insert([
            'code' => 'DSM074933XDD',
            'name' => "Giày Thể Thao Nam Biti's DSM074933XDD (Xanh Dương Đậm)",
            'desc' => '',
            'color_id' => '11',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '4',
            'product_tail_id' => '4'
        ]);
        DB::table('products')->insert([
            'code' => 'DSMH08800KEM',
            'name' => "Giày Thể Thao Nam Biti's Hunter Street - Retro Collection DSMH08800KEM (Kem)",
            'desc' => '',
            'color_id' => '5',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '4',
            'product_tail_id' => '1'
        ]);
        DB::table('products')->insert([
            'code' => 'DSMH08800NAU',
            'name' => "Giày Thể Thao Nam Biti's Hunter Street - Retro Collection DSMH08800NAU (Nâu)",
            'desc' => '',
            'color_id' => '6',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '4',
            'product_tail_id' => '1'
        ]);
        DB::table('products')->insert([
            'code' => 'DSMH09100DEN',
            'name' => "Giày Bóng Đá Nam Biti's Hunter Football Futsal DSMH09100DEN (Đen)",
            'desc' => "Mùa Hè trở lại kéo theo bầu không khí thể thao cuồng nhiệt từ những trận cầu đường phố lan tỏa khắp mọi nơi. 
            Để giúp bạn thêm tự tin và thoải mái gia nhập vào mọi cuộc vui ngẫu hứng, Biti’s cho ra mắt bộ sưu tập Biti’s Hunter Football Futsal hoàn toàn mới - sở hữu những tính năng hỗ trợ tuyệt vời cùng thiết kế trẻ trung năng động với 3 phiên bản màu khác nhau, phiên bản này sẽ là sự lựa chọn hoàn hảo với những ưu điểm độc đáo: 
             
            ⚡️ LITEFIT CUSHION: Đế cao su đúc nguyên khối, mềm dẻo và uốn gấp tốt, cùng hoa văn đế tăng ma sát và bám tối đa trên sàn gỗ, sân xi măng hay trên đường phố. Phom đế thon gọn, ôm sát chân để hỗ trợ rê bóng và sút bóng tốt. 
            ⚡️ TRUEFIT LITEKNIT UPPER: Da lộn Suede cao cấp, mang đến cảm giác mềm mại, nhẹ nhàng và độ bền cao. Vải lưới xốp Airmesh cấu tạo từ sợi Polyester có khả năng chịu lực cao và chống co giãn. Gót hậu được gia cố lớp nhựa chắc chắn, ôm gọn chân. Lưỡi gà với si nubuck mặt ngoài tăng tiếp xúc bóng và lớp vải mềm êm ái mặt trong. 
            ⚡️ LÓT ĐẾ TRONG: Thun cá sấu hút ẩm, thoáng khí tốt. Kết hợp cùng chất liệu mousse chống trầy xước, đảm bảo êm ái tối đa. Dễ dàng mix-match với nhiều phong cách 'cool ngầu' nhờ kiểu dáng trẻ trung, phối màu hiện đại và thời trang.",
            'color_id' => '1',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '4',
            'product_tail_id' => '1'
        ]);
        DB::table('products')->insert([
            'code' => 'DSMH09100XDG',
            'name' => "Giày Bóng Đá Nam Biti's Hunter Football Futsal DSMH09100XDG (Xanh Dương)",
            'desc' => "Mùa Hè trở lại kéo theo bầu không khí thể thao cuồng nhiệt từ những trận cầu đường phố lan tỏa khắp mọi nơi. 
            Để giúp bạn thêm tự tin và thoải mái gia nhập vào mọi cuộc vui ngẫu hứng, Biti’s cho ra mắt bộ sưu tập Biti’s Hunter Football Futsal hoàn toàn mới - sở hữu những tính năng hỗ trợ tuyệt vời cùng thiết kế trẻ trung năng động với 3 phiên bản màu khác nhau, phiên bản này sẽ là sự lựa chọn hoàn hảo với những ưu điểm độc đáo: 
             
            ⚡️ LITEFIT CUSHION: Đế cao su đúc nguyên khối, mềm dẻo và uốn gấp tốt, cùng hoa văn đế tăng ma sát và bám tối đa trên sàn gỗ, sân xi măng hay trên đường phố. Phom đế thon gọn, ôm sát chân để hỗ trợ rê bóng và sút bóng tốt. 
            ⚡️ TRUEFIT LITEKNIT UPPER: Da lộn Suede cao cấp, mang đến cảm giác mềm mại, nhẹ nhàng và độ bền cao. Vải lưới xốp Airmesh cấu tạo từ sợi Polyester có khả năng chịu lực cao và chống co giãn. Gót hậu được gia cố lớp nhựa chắc chắn, ôm gọn chân. Lưỡi gà với si nubuck mặt ngoài tăng tiếp xúc bóng và lớp vải mềm êm ái mặt trong. 
            ⚡️ LÓT ĐẾ TRONG: Thun cá sấu hút ẩm, thoáng khí tốt. Kết hợp cùng chất liệu mousse chống trầy xước, đảm bảo êm ái tối đa. Dễ dàng mix-match với nhiều phong cách 'cool ngầu' nhờ kiểu dáng trẻ trung, phối màu hiện đại và thời trang.",
            'color_id' => '12',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '4',
            'product_tail_id' => '1'
        ]);
        DB::table('products')->insert([
            'code' => 'DSWH05100REU',
            'name' => "Giày Thể Thao Cao Cấp Nữ Biti's Hunter X Army Green DSWH05100REU (Rêu)",
            'desc' => '',
            'color_id' => '7',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '6',
            'product_tail_id' => '1'
        ]);
        DB::table('products')->insert([
            'code' => 'DSWH08700TRG',
            'name' => "Giày Thể Thao Nữ Biti's Hunter Core 3D-Airmesh White DSWH08700TRG (Trắng)",
            'desc' => '',
            'color_id' => '8',
            'category_id' =>'10',
            'supplier_id' => '1',
            'sex_id' => '6',
            'product_tail_id' => '1'
        ]);

    }
}
