<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResourse extends JsonResource
{

    public function toArray($request)
    {
        $msg='';
        $child='';
        if (($this->children)->count()>0){

            $msg=true;
            $child=$this->children;
        }else{
            $msg=false;
            $child='';

        }
        $arrayData= [
            'id'=>$this->id,
            'name'=>$this->name,
            'image'=>$this->image(),
            'is_subcategory'=>$msg,

        ];

        if (($this->children)->count()>0){
            $arrayData['child']=CategoryResourse::collection($this->children);

        }
        return $arrayData;
    }
}
