<?php

namespace App\Models\Inspector\Cutting\Measure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $table = 'cutting_panel_measure_record';
    protected $fillable = [
        'actual','actual_in_decimal', 'is_positive','is_match','position'
    ];
    protected $casts = [
        'is_positive' => 'boolean',
        'is_match' => 'boolean',
        'actual_in_decimal'=> 'float'
    ];
    public $timestamps = false;

}
