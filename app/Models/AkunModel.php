<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AkunModel extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'users';

    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'role',
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $hidden;
}