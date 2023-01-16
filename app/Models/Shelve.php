<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shelve extends Model
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
  
    protected function get_branch_name()
    {
        return $this->hasOne(Branch::class, 'id', 'branch')->latest();
    }
}
