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
        'category',
        'product_code',
        'product_code_supplier',
        'product_color',
        'supplier_id',
        'manufacturer',
        'active',
    ];
  
    protected function get_category_name()
    {
        return $this->hasOne(Category::class, 'id', 'category')->latest();
    }
    protected function get_supplier_name()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id')->latest();
    }
}
