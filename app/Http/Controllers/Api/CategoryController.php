<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResourse;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use GeneralTrait;

    public function index(Request $request){

        try{
            $data= CategoryResourse::collection(Category::whereNull('parent_id')->get());
            return $this->returnData('data', $data,'ok');

        }catch (\Exception $exception){
         return   $this->returnError('500','هناك خطا ما يرجى المحاولة لاحقا');
        }

    }

    public function subCategory(Request $request){
        try{
            $data=  CategoryResourse::collection(Category::where('parent_id',$request->id)->get());
            return $this->returnData('data', $data);
        }catch (\Exception $exception){
            return $this->returnError('500','هناك خطا ما يرجى المحاولة لاحقا');

        }

    }
}
