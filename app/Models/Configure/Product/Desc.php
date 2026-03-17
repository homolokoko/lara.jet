<?php

namespace App\Models\Configure\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desc extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table="product_desc";
    public $timestamps = false;
}
