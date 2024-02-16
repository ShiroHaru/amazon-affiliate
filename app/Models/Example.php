<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    use HasFactory;

    //保存時に変更が不可能なカラムを指定する
    //protected $guarded = ['id', 'created_at', 'updated_at'];

    //保存時に変更が不可なカラムを指定する
    protected $fillable = [
        'name',
        'num',
    ];
}
