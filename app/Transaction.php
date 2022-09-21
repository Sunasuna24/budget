<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $fillable = [
        'description',
        'amount',
        'category_id',
        'user_id'
    ];

    public static function boot()
    {
        static::addGlobalScope('user', function ($query) {
            $query->where('user_id', \auth()->id());
        });
    }
 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeByCategory($query, Category $category)
    {
        if ($category->exists) {
            $query->where('category_id', $category->id);
        }
    }
}
