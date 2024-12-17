<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    //保存時に変更が可能なカラムを指定する
    protected $fillable = [
        'name',
        'description',
    ];

    //一対多の子のcategoryへのリレーション
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
