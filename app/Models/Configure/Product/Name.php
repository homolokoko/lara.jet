<?php

namespace App\Models\Configure\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Name extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $fillable = ['name'];
    protected $table = "product";
    public $timestamps = false;
    protected $translationForeignKey = 'product_id';
    public $translatedAttributes = ['translated'];
}
