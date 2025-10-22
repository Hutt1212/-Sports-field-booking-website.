<?php

namespace Database\Seeders;

use App\Models\SportsField;
use Illuminate\Database\Seeder;

class SportsFieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'name' => 'CLB Thể Thao Thanh Niên Quận 1',
                'sport_type' => 'Bóng đá',
                'description' => 'Sân bóng đá chuyên nghiệp với cơ sở vật chất tuyệt vời',
                'type' => 'Ngoài trời',
                'location' => 'Quận 1',
                'address' => '109 Đường Nguyễn Huệ, P. Bến Nghé, Quận 1, TP.HCM',
                'size' => 'Sân 7',
                'surface' => 'Cỏ nhân tạo',
                'price_per_90min' => 550000.00,
                'status' => 'active',
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'image' => 'https://img.thegioithethao.vn/thumbs/san-bong-da/ho-chi-minh/quan-go-vap/san-bong-thanh-nien/san-bong-thanh-nien-3_thumb_720.webp',
            ],
            [
                'name' => 'Nhà Thi Đấu Cầu Lông Quận 3',
                'sport_type' => 'Cầu lông',
                'description' => 'Sân cầu lông trong nhà đạt chuẩn thi đấu',
                'type' => 'Trong nhà',
                'location' => 'Quận 3',
                'address' => '200 Đường Pasteur, P. 6, Quận 3, TP.HCM',
                'size' => 'Kích thước chuẩn',
                'surface' => 'Sân trong nhà',
                'price_per_90min' => 120000.00,
                'status' => 'active',
                'opening_time' => '06:00:00',
                'closing_time' => '21:00:00',
                'image' => 'https://qvbadminton.com/wp-content/uploads/2024/11/san-cau-long-quan-3-5d6c4a37.webp',
            ],
            [
                'name' => 'Sân Bóng Rổ Cộng Đồng Thủ Đức',
                'sport_type' => 'Bóng rổ',
                'description' => 'Sân bóng rổ ngoài trời dành cho cộng đồng',
                'type' => 'Ngoài trời',
                'location' => 'TP. Thủ Đức',
                'address' => '55 Đường Võ Văn Ngân, P. Linh Chiểu, TP. Thủ Đức',
                'size' => 'Kích thước chuẩn',
                'surface' => 'Sân ngoài trời',
                'price_per_90min' => 200000.00,
                'status' => 'active',
                'opening_time' => '06:00:00',
                'closing_time' => '22:00:00',
                'image' => 'https://vending-cdn.kootoro.com/torov-cms/upload/image/1735090480892-san-bong-ro-09.jpg',
            ],
            [
                'name' => 'Sân bóng đá mini Tao Đàn',
                'sport_type' => 'Bóng đá',
                'description' => 'Cụm sân bóng đá mini mặt cỏ tự nhiên giữa trung tâm',
                'type' => 'Ngoài trời',
                'location' => 'Quận 1',
                'address' => 'Công viên Tao Đàn, Trương Định, P. Bến Thành, Quận 1',
                'size' => 'Sân 5',
                'surface' => 'Cỏ tự nhiên',
                'price_per_90min' => 300000.00,
                'status' => 'active',
                'opening_time' => '07:00:00',
                'closing_time' => '20:00:00',
                'image' => 'https://img.thegioithethao.vn/thumbs/san-bong-da/ho-chi-minh/quan-1/san-bong-tao-dan/san-bong-tao-Dan-4_thumb_150.webp',
            ],
            [
                'name' => 'Sân Quần Vợt Kỳ Hòa',
                'sport_type' => 'Tennis',
                'description' => 'Cụm sân tennis chuyên nghiệp, có mái che',
                'type' => 'Ngoài trời',
                'location' => 'Quận 10',
                'address' => '796 Sư Vạn Hạnh, P. 12, Quận 10, TP.HCM',
                'size' => 'Kích thước chuẩn',
                'surface' => 'Sân ngoài trời',
                'price_per_90min' => 250000.00,
                'status' => 'active',
                'opening_time' => '06:00:00',
                'closing_time' => '22:00:00',
                'image' => 'https://babolat.com.vn/wp-content/uploads/2024/01/san-danh-tennis-chat-luong.jpg',
            ],
            [
                'name' => 'Sân Thể Thao Đa Năng Phú Nhuận',
                'sport_type' => 'Cricket',
                'description' => 'Sân cricket đa năng ngoài trời',
                'type' => 'Ngoài trời',
                'location' => 'Quận Phú Nhuận',
                'address' => '159 Nguyễn Văn Trỗi, P. 11, Quận Phú Nhuận, TP.HCM',
                'size' => 'Kích thước chuẩn',
                'surface' => 'Cỏ nhân tạo',
                'price_per_90min' => 450000.00,
                'status' => 'active',
                'opening_time' => '08:30:00',
                'closing_time' => '22:00:00',
                'image' => 'https://lh3.googleusercontent.com/proxy/3v3AaqUSVtb4Uys_FiSIKXenEBP81tvGhfl_UXTsrx68vwMyGrMoU65NcXHLcV3VH9LzP1y5EASItCAtouAso4b5EzaDnUqCIHE',
            ],




            [
                'name' => 'Học Viện Bóng Đá PVF',
                'sport_type' => 'Bóng đá',
                'description' => 'Sân tập chuyên nghiệp của học viện bóng đá PVF',
                'type' => 'Ngoài trời',
                'location' => 'Hưng Yên',
                'address' => 'Văn Giang, Hưng Yên',
                'size' => 'Sân 11',
                'surface' => 'Cỏ tự nhiên',
                'price_per_90min' => 1500000.00,
                'status' => 'active',
                'opening_time' => '08:00:00',
                'closing_time' => '17:00:00',
                'image' => 'https://media.vov.vn/sites/default/files/styles/large_watermark/public/2021-02/vov__2__yepa.jpg',
            ],
            [
                'name' => 'Khu Phức Hợp Thể Thao Celadon City',
                'sport_type' => 'Bóng đá',
                'description' => 'Sân bóng đá 7 người trong khu đô thị cao cấp',
                'type' => 'Ngoài trời',
                'location' => 'Quận Tân Phú',
                'address' => 'Đường N1, Celadon City, P. Sơn Kỳ, Quận Tân Phú, TP.HCM',
                'size' => 'Sân 7',
                'surface' => 'Cỏ nhân tạo',
                'price_per_90min' => 600000.00,
                'status' => 'active',
                'opening_time' => '07:00:00',
                'closing_time' => '23:00:00',
                'image' => 'https://diaoc084.com/wp-content/uploads/2021/08/celadon-city-emerald-san-bong-0919402958-1024x687.jpg',
            ],
        ];

        foreach ($fields as $field) {
            SportsField::create($field);
        }
    }
}
