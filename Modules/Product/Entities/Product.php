<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product';
    protected $fillable = ['name','price','discount','in_stock','out_stock','is_available','release_date'];
    public $appends = ['image_output'];

    public function image()
    {
        return $this
            ->hasOne(
                ProductImage::class,
                'product_id'
            )->where('sort',1);
    }

    public function images()
    {
        return $this
            ->hasMany(
              ProductImage::class,
              'product_id'
            );
    }

    public function getImageOutputAttribute()
    {
        $image = $this->images()->where(['product_id'=>$this->id,'sort'=>1]);
        return $image->exists() ? $image->first()->url : asset('snapchat.png');
    }

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductFactory::new();
    }
}
