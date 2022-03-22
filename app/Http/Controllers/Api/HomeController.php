<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\BooksResourse;
use App\Http\Resources\CategoryIdResourse;
use App\Http\Resources\CategoryResourse;
use App\Models\Banner;
use App\Models\Book;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use GeneralTrait;

    public function index(Request $request){
//        $data['type']['banner']= BannerResource::collection(Banner::get());

        $category = Category::where('id',1)->first();

        $data= array((object) [
        'type' => 'banner',
        'banner' => BannerResource::collection(Banner::get()),
    ], (object) [
        'type' => 'books',
        'books' => (object) [
            'category_id' => $category->id,
          'category_name' =>  $category->name,
            'Books' => BooksResourse::collection($category->books),
        ],
    ], (object) [
        'type' => 'slider1',
        'slider1' => (object) [
            'image' => 'https://via.placeholder.com/800x600.png',
            'link' =>'https://via.placeholder.com/800x600.png'
    ],
    ],(object) [
                'type' => 'slider2',
                'slider2' =>  [
                    (object)[

                    'image' => 'https://via.placeholder.com/800x600.png',
                    'link' =>'https://via.placeholder.com/800x600.png'
                ],
                    (object)[

                        'image' => 'https://via.placeholder.com/800x600.png',
                        'link' =>'https://via.placeholder.com/800x600.png'
                    ],
                    ],

            ],
            (object) [
                'type' => 'books',
                'books' => (object) [
                    'category_id' => $category->id,
                    'category_name' =>  $category->name,
                    'Books' => BooksResourse::collection($category->books),
                ],
            ],(object) [
                'type' => 'slider1',
                'slider1' => (object) [
                    'image' => 'https://via.placeholder.com/800x600.png',
                    'link' =>'https://via.placeholder.com/800x600.png'
                ],
            ],(object) [
                'type' => 'slider2',
                'slider2' =>  [
                    (object)[

                        'image' => 'https://via.placeholder.com/800x600.png',
                        'link' =>'https://via.placeholder.com/800x600.png'
                    ],
                    (object)[

                        'image' => 'https://via.placeholder.com/800x600.png',
                        'link' =>'https://via.placeholder.com/800x600.png'
                    ],
                ],

            ],
            (object) [
                'type' => 'books',
                'books' => (object) [
                    'category_id' => $category->id,
                    'category_name' =>  $category->name,
                    'Books' => BooksResourse::collection($category->books),
                ],
            ],
);
        return $this->returnData('data', $data,'ok');

    }
}

//[{type:banner,items:[banner]}]
