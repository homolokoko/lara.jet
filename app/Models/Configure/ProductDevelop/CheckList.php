<?php

namespace App\Models\Configure\ProductDevelop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CheckList extends Model implements TranslatableContract
{
    use Translatable;
    public $incrementing = true;
    use HasFactory;
    protected $table = 'develop_product_checklist';
    public $fillable = ['code'];
    public $translatedAttributes = ['name'];

    function scopeGetCodeName($q, $v)
    {
        return $q->where(['code' => $v]);
    }
}
