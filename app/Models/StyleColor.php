<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StyleColor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'style_color';
    protected $fillable = ['style_id','color_id'];

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_id'
            );
    }

    public function color()
    {
        return $this
            ->belongsTo(
                Color::class,
                'color_id'
            );
    }

}
