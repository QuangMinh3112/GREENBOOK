<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();
        \App\Models\Category::factory(30)->create();
        \App\Models\Book::factory(100)->create();
        \App\Models\CategoryPost::factory(10)->create();
        \App\Models\Coupon::factory(30)->create();
        \App\Models\Post::factory(100)->create();
        DB::table('users')->insert([
            'name' => 'admin',
            'avatar' => '',
            'address' => '',
            'phone_number' => '',
            'role' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
        ]);
        DB::table('users')->insert([
            'name' => 'test',
            'avatar' => '',
            'address' => '',
            'phone_number' => '',
            'role' => 1,
            'is_vertify' => 1,
            'email' => 'minhvqph27791@fpt.edu.vn',
            'password' => Hash::make('123123'),
        ]);
        // DB::table('coupons')->insert([
        //     'name' => 'Mã giảm giá người mới',
        //     'code' => 'WELCOMETOGREENBOOK',
        //     'discount' => 10,
        //     'value' => 'percent',
        //     'status' => 'public',
        // ]);
        // DB::table('coupons')->insert([
        //     'name' => 'Mã giảm giá người hạng bạc',
        //     'code' => 'SILVERCOUPON',
        //     'discount' => 20,
        //     'value' => 'percent',
        //     'status' => 'public',
        //     'point_required' => 200,
        // ]);
        // DB::table('coupons')->insert([
        //     'name' => 'Mã giảm giá hạng vàng',
        //     'code' => 'GOLDCOUPON',
        //     'discount' => 30,
        //     'value' => 'percent',
        //     'status' => 'public',
        //     'point_required' => 200,
        // ]);

        DB::table('categories')->insert([
            'name' => 'Sách Giáo Khoa',
            'description' => 'Sách giáo khoa là những tài liệu được thiết kế và biên soạn đặc biệt để hỗ trợ quá trình giảng dạy và học tập trong các hệ thống giáo dục chính thức. Các sách giáo khoa thường được sử dụng trong các cấp học từ mầm non đến đại học và thậm chí cả trong các khóa đào tạo sau đại học.',
            'slug' => Str::slug('Sách giáo khoa'),
        ]);
        DB::table('categories')->insert([
            'name' => 'Truyện Tranh',
            'description' => 'Truyện tranh là một hình thức nghệ thuật kể chuyện sử dụng hình ảnh và từ ngữ, thường được sắp xếp trong các ô vuông nhỏ gọi là "hình khung" hoặc "khung tranh" để diễn đạt cốt truyện. Các truyện tranh có thể bao gồm nhiều thể loại khác nhau và phát triển từ nhiều nền văn hóa khác nhau.',
            'slug' => Str::slug('Truyện Tranh'),
        ]);
        DB::table('categories')->insert([
            'name' => 'Sách Tiểu Thuyết',
            'description' => 'Kể một câu chuyện hư cấu với các nhân vật và sự kiện tưởng tượng. Các thể loại bao gồm tiểu thuyết lãng mạn, kinh điển, hài hước, khoa học viễn tưởng, và nhiều thể loại khác.',
            'slug' => Str::slug('Sách Tiểu Thuyết'),
        ]);
        DB::table('categories')->insert([
            'name' => 'Toán',
            'description' => 'Sách giáo khoa Toán được biên soạn theo các tiêu chuẩn chương trình giáo dục quốc gia hoặc địa phương. Nó phản ánh những kiến thức và kỹ năng Toán học cần thiết cho một cấp độ học tập cụ thể.',
            'slug' => Str::slug('Toán'),
            'parent_id' => '1'
        ]);
        DB::table('categories')->insert([
            'name' => 'Ngữ Văn',
            'description' => 'Mô tả thể loại văn học của sách, có thể là tiểu thuyết, truyện ngắn, thơ, kịch, tiểu luận, hay các dòng văn học khác như huyền bí, khoa học viễn tưởng, lịch sử, và tình cảm.',
            'slug' => Str::slug('Ngữ Văn'),
            'parent_id' => '1'
        ]);
        DB::table('categories')->insert([
            'name' => 'Tiếng Anh',
            'description' => 'Sách giáo khoa tiếng Anh được thiết kế để giúp học sinh phát triển kỹ năng ngôn ngữ Anh cơ bản và nâng cao. Những cuốn sách này không chỉ tập trung vào việc giảng dạy ngữ pháp và từ vựng, mà còn cung cấp cơ hội cho học sinh thực hành bốn kỹ năng chính: nghe, nói, đọc, và viết.',
            'slug' => Str::slug('Tiếng Anh'),
            'parent_id' => '1'
        ]);
    }
}
