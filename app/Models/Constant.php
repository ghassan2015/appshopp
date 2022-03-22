<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Constant extends Model
{
    use HasFactory;
  use HasTranslations;

    public $translatable = ['name'];

    use HasFactory;
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public $guarded=[];

    protected $casts = [
        'name' => 'array',
    ];
}
