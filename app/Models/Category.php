<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //保存時に変更が不可なカラムを指定する
    protected $fillable = [
        'name',
    ];

    //多対多のリレーション
    public function origins()
    {
        return $this->belongsToMany(Origin::class)->withTimestamps();
    }
}
