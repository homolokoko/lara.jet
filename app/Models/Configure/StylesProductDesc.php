<?php

namespace App\Models\Configure;
use Illuminate\Database\Eloquent\Model;

class StylesProductDesc extends Model
{
    public  $fillable = [
        'style_id',
        'name',
    ];
    public $table = 'style_product_desc';

    function scopeStyle($query, $styleId)
    {
        $query->where('style_id', $styleId);
    }

}