<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ツリー構造のNodeTraitを使用
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    // ツリー構造のNodeTraitを使用
    use NodeTrait;

    //保存時に変更が可能なカラムを指定する
    protected $fillable = [
        'name',
        'parent_id'
    ];

    //子カテゴリを取得するためのリレーションを定義します。
    // public function children()
    // {
    //     return $this->hasMany(Category::class, 'parent_id');
    // }

    //一対多の親のfeatureへのリレーション
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    //多対多のリレーション
    public function origins()
    {
        return $this->belongsToMany(Origin::class)->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
