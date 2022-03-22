<?php

namespace App\Http\Resources;

use App\Models\Constant;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BooksResourse extends JsonResource
{

    public function toArray($request)
    {

        $constant_type_book=Constant::find($this->type_book);
        $arrayData = [
            'id'=>$this->id,
            'title'=>$this->title,
            'image'=>$this->image,
            'author_name'=>$this->author_name,
            'price'=>$this->price,
            'type_book'=>$constant_type_book->name,
            'status_publish_cd'=>$this->status_publish->name,
        ];



        if (Auth::guard('api')->check()){
            $arrayData['status_using_book_cd']=$this->status_using_book_cd ?? null;

        }
        return $arrayData;
    }
}
