<?php

namespace App\Models\Configure\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_translation';
    protected $fillable = ['locale', 'translated'];
}
