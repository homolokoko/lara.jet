<?php

namespace App\Models\Inspector\Endline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GarmentReworkRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'insp_endline_item_rework_records';

    protected $fillable = [
        'locate_id',
        'inspector_id',
        'is_pass',
        'item_id',
    ];

    protected $casts = [
        'is_pass' => 'boolean',
    ];
}
