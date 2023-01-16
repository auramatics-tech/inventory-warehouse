<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'supplier_id'
    ];
    protected function get_product_detail()
    {
        return $this->hasMany(Product::class, 'id', 'product_id')->latest();
    }
    
}
