<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name', 'permissions'   // json field
    ];

    public function users()
    {
        $this->hasMany(User::class,'role_id','id');
    }

    public function getPermissionsAttribute($permissions)
    {
        return json_decode($permissions, true);
    }
    protected $casts = [
        'permissions' => 'array',
    ];
}
