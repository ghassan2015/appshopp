<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public function supervisor(){
        return $this->belongsTo(User::class,'supervisor_id','id');
    }
    public function freelancer(){
        return $this->belongsTo(User::class,'freelancer_id','id');
    }

}
