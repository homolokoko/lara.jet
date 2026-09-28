<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Model;

class StyleSize extends Model
{
    protected $fillable = [
        'style_id',
        'size_id',
    ];

    public function sizes()
    {
        return $this->belongsTo('App\Models\Configure\Size', 'size_id');
    }
}
