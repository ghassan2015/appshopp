<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name','description','slug'];

    use HasFactory;
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public $guarded=['id','created_at','updated_at'];
    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }
    public function image(){
        if($this->image==null)
            return env('DEFAULT_IMAGE');
        else
            return  asset("assets/images/categories/".$this->image);
    }



    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id','id');
    }
    public function skills(){
        return $this->hasMany(Skill::class, 'category_id', 'id');

    }
    public function category_status_cd() {
        return $this->belongsTo(Constant::class, "status_cd", "id");
    }

    public function option(){
        return $this->belongsToMany(Option::class,'category_option');
    }

    public function books(){
        return $this->belongsToMany(Book::class,'book_categories');
    }

    public function probabilty(){
        return $this->hasMany(ProbabilityOption::class);
    }

}
