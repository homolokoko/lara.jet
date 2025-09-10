<?php

namespace App\Models\Inspector\ProductDevelopment\Record;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;
    public $table = 'develop_product_record_measure';
    protected $fillable = [
        'header_id', 'checkpoint_id', 'actual',
        'actual_in_decimal', 'different', 'is_less',
        'is_tally', 'is_more',    'is_accept',    'is_valid',   'measure_tolerance_define_id'
    ];
    public $timestamps = false;
}
