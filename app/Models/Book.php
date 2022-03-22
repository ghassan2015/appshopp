<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Book extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded =[];
    public $translatable = ['title','description'];

    public function category(){
        return $this->belongsToMany(Category::class,'book_categories');
    }

    public function size_paper()
    {
        return $this->belongsTo(Constant::class, "size_paper_cd",);
    }

    public function color_paper()
    {
        return $this->belongsTo(Constant::class, "color_paper_cd",);
    }
    public function color_print()
    {
        return $this->belongsTo(Constant::class, "color_print_cd",);
    }

    public function side_print()
    {
        return $this->belongsTo(Constant::class, "side_print_cd",);
    }
    public function cover(){
        return $this->belongsTo(Constant::class, "cover_cd",);

    }
    public function side_cover(){
        return $this->belongsTo(Constant::class, "side_cover_cd",);

    }

    public function status_using_book(){
        return $this->belongsTo(Constant::class, "status_using_book_cd",);
    }
    public function status_publish(){
        return $this->belongsTo(Constant::class, "status_publish_cd",);
    }
    public function version_type_book(){
        return $this->belongsTo(Constant::class, "version_type_book_cd",);
    }

    public function status(){
        return $this->belongsTo(Constant::class, "status_cd",);
    }

}
