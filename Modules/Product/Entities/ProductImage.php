<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'product_image';
    protected $fillable = ['product_id','file_path','sort'];
    public $appends = ['url'];

    public function getUrlAttribute()
    {
        if(!$this->file_path)
            return asset('snapchat.png');
        else
            return asset(Storage::url($this->file_path));
    }

    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductImageFactory::new();
    }
}
