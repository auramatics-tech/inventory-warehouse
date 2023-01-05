<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'active',
    ];
  
    protected function get_category_name()
    {
        return $this->hasOne(Category::class, 'id', 'category')->latest();
    }
}
