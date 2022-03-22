<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbabilityOption extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts = [
        'option_id' => 'array',
    ];
}
