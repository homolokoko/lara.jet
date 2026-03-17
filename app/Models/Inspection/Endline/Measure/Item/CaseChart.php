<?php

namespace App\Models\Inspector\Endline\Measure\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseChart extends Model
{
    use HasFactory;
    //
    public $table = "endline_measure_repair_chart";
    protected $fillable = ['header_id', 'endline_measure_chart_id'];

    function inspect()
    {
        return $this->belongsTo(\App\Models\Inspector\Endline\Measure\Chart::class, 'endline_measure_chart_id');
    }
}
