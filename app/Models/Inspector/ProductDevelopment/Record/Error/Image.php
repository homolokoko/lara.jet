<?php

namespace App\Models\Inspector\ProductDevelopment\Record\Error;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    //
    public $table = 'develop_product_record_image';
    protected $fillable = ['image', 'desc'];
    protected $appends = ['imageSrc'];

    public function getImageSrcAttribute()
    {
        return Storage::disk('productDevelopment')->url($this->image);
    }
}
