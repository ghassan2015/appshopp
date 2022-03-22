<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Skill extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
public $guarded=[];
    use HasFactory;
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function project(){
        return $this->belongsTo(Project::class,'skill_id','id');

    }
    public function user(){
        return $this->belongsToMany(User::class,'user_skills');
    }

}
