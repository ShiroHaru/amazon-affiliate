<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'asin',
    ];

    //多対多のリレーション
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
