<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Color;

class StyleColor extends Model
{
    protected $table = 'style_colors';
    protected $fillable = [
        'style_id',
        'color_id',
    ];

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
