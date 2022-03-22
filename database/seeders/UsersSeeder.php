<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Category;
use App\Models\Constant;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{

    public function run()
    {
  $constants=[
      [
      'is_managed'=>0,
      'parent_id'=>0,
      's_key'=>'status_cd',
      'name'=>['ar'=>'الحالة','en'=>'status'],

  ],
      [
      'is_managed'=>0,
      'parent_id'=>1,
      's_key'=>'status_cd',
      'name'=>['ar'=>'فعال','en'=>'active'],
      ],
      [
      'is_managed'=>0,
      'parent_id'=>1,
      's_key'=>'status_cd',
      'name'=>['ar'=>'غير فعال','en'=>' non active'],
  ],


      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'size_paper_cd',
          'name'=>['ar'=>'حجم الورقة','en'=>'size paper cd'],
      ],


      [
          'is_managed'=>0,
          'parent_id'=>4,
          's_key'=>'size_paper_cd',
          'name'=>['ar'=>'A4','en'=>'A4'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>4,
          's_key'=>'size_paper_cd',
          'name'=>['ar'=>'A5','en'=>'A5'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>4,
          's_key'=>'size_paper_cd',
          'name'=>['ar'=>'A3','en'=>'A3'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'color_paper_cd',
          'name'=>['ar'=>'لون الورقة','en'=>'color paper'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>8,
          's_key'=>'color_paper_cd',
          'name'=>['ar'=>'احمر','en'=>'red'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>8,
          's_key'=>'color_paper_cd',
          'name'=>['ar'=>'ابيض','en'=>'white'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>8,
          's_key'=>'color_paper_cd',
          'name'=>['ar'=>'اسود','en'=>'black'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'color_print_cd',
          'name'=>['ar'=>' لون الطباعة','en'=>'color print '],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>12,
          's_key'=>'color_print_cd',
          'name'=>['ar'=>'اسود','en'=>'black'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>12,
          's_key'=>'color_print_cd',
          'name'=>['ar'=>'ملون','en'=>'color'],
      ],


      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'side_print_cd',
          'name'=>['ar'=>'اتجاه الطباعة','en'=>'side print'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>15,
          's_key'=>'side_print_cd',
          'name'=>['ar'=>'يمين','en'=>'right'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>15,
          's_key'=>'side_print_cd',
          'name'=>['ar'=>'يسار','en'=>'left'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'cover_cd',
          'name'=>['ar'=>'نوع الغلاف','en'=>'cover'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>18,
          's_key'=>'cover_cd',
          'name'=>['ar'=>'مقوى','en'=>'reinforced'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>18,
          's_key'=>'cover_cd',
          'name'=>['ar'=>'عادي','en'=>'normal'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'status_using_book_cd',
          'name'=>['ar'=>'حالة الكتاب','en'=>' status using book'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>21,
          's_key'=>'status_using_book_cd',
          'name'=>['ar'=>'مستخدم','21'=>'old'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>21,
          's_key'=>'status_using_book_cd',
          'name'=>['ar'=>'جديد','en'=>'new'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'side_cover_cd',
          'name'=>['ar'=>'اتجاه الغلاف','en'=>'side cover'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>24,
          's_key'=>'side_cover_cd',
          'name'=>['ar'=>'يمين','en'=>'right'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>24,
          's_key'=>'side_cover_cd',
          'name'=>['ar'=>'يسار','en'=>'left'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'status_publish_cd',
          'name'=>['ar'=>'حالة النشر','en'=>'status publish'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>27,
          's_key'=>'status_publish_cd',
          'name'=>['ar'=>'منشور','en'=>'publish'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>27,
          's_key'=>'status_publish_cd',
          'name'=>['ar'=>'قيد المراجعة','en'=>'review'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>27,
          's_key'=>'status_publish_cd',
          'name'=>['ar'=>'مرفوض','en'=>'rejected'],
      ],


      [
          'is_managed'=>0,
          'parent_id'=>0,
          's_key'=>'version_type_book_cd',
          'name'=>['ar'=>'نوع النسخة','en'=>'version type'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>31,
          's_key'=>'version_type_book_cd',
          'name'=>['ar'=>'نسخة مطبوعة','en'=>'offprint'],
      ],

      [
          'is_managed'=>0,
          'parent_id'=>31,
          's_key'=>'version_type_book_cd',
          'name'=>['ar'=>'نسخة مسموعة','en'=>'audio version'],
      ],
      [
          'is_managed'=>0,
          'parent_id'=>31,
          's_key'=>'version_type_book_cd',
          'name'=>['ar'=>'نسخة الكترونية','en'=>'electronic copy'],
      ],



      ];

  foreach ($constants as $value) {
      Constant::updateOrCreate($value);
  }
//
//
                Role::updateOrCreate(
                    ['name' => 'Admin'],
                    ['permissions' => array('main','categories','admins','roles','posts','transfers','contact','settings','traffics','error-reports')]
                );
//



                $users = \App\Models\User::where('power',"ADMIN")->count();
                if($users==0)
                    \App\Models\User::create([
                        'first_name'=>"ADMIN",
                        'last_name'=>"ADMIN",
                        'role_id'=>1,
                        'power'=>"ADMIN",
                        'email'=>'admin@admin.com',
                        'email_verified_at'=>date("Y-m-d h:i:s"),
                        'password'=>bcrypt('password')
                    ]);
        Book::factory()->count(20)->create();
        BookCategory::factory()->count(20)->create();

        Banner::factory()->count(3)->create();
    }
}
