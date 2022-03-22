<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResourse;
use App\Http\Resources\CategoryResourse;
use App\Models\Book;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
class BooksController extends Controller
{
    use GeneralTrait;

    public function index(Request $request)
    {

        $publish_status = $request->publish_status ?? null;

        if ($request->category_id) {
            $category = Category::with(['books'])->where('id',$request->category_id)->first();

                $data = BooksResourse::collection($category->books);
        } else if (Auth::guard('api')->check() && $publish_status) {
            $books = Book::where('user_id',Auth::guard('api')->id())->where('status_publish_cd', $publish_status)->get();
            $data = BooksResourse::collection($books);

        } else {
            $data = BooksResourse::collection(Book::all());
        }

        return $this->returnData('data', $data,'ok');


    }

    public function Details(Request $request){

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {

            if (Book::where('id',$request->id)->first()) {
                $data = new BooksResourse(Book::where('id', $request->id)->first());
                return $this->returnData('data', $data);
            }else{
                return $this->returnError('404','هذا المنتج غير متوفر');

            }
        }catch (\Exception $exception){
            return $this->returnError('400','هناك خطا حاول لاحقا');
        }




    }
}
