<?php

namespace App\Models\Inspector\FBC;

use App\Models\Configure\Color;
use App\Models\Configure\Size;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasureItem extends Model
{
    use HasFactory;
    protected $table = 'fbc_measure_items';
    protected $fillable = ['header_id', 'inspector','color','size','is_pass'];

    function header(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Profile::class, 'header_id');
    }
    function inspector(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector');
    }
    function record(){
        return $this->hasMany(MeasureChart::class, 'item_id');
    }
    function colors()
    {
        return $this->belongsTo(Color::class,"color");
    }
    function sizes()
    {
        return $this->belongsTo(Size::class, 'size');
    }
}
