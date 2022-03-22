<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasFactory;
    use HasTranslations;
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public $translatable = ['name'];
    public function attribute(){
    return $this->belongsTo(Attribute::class,'attribute_id');
    }



    public function category(){
        return $this->belongsToMany(Category::class,'category_option')->withPivot('price');
    }
}
