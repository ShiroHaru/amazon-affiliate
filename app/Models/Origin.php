<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;

    //保存時に変更が不可なカラムを指定する
    protected $fillable = [
        'note',
    ];

    //多対多のリレーション
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
