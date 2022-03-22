<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Project extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name','slug','description'];

    protected $guarded=[];
    use HasFactory;
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function skills(){
        return  $this->belongsToMany(Skill::class,'project_skills');
    }
    public function attachments(){
        return  $this->belongsToMany(Attachment::class,'attachments',);
    }
}
