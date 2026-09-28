<?php

namespace App\Models\Configure\Measurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkpoints extends Model
{
    use HasFactory;
    protected $table = 'measurement_check_points';
    protected $fillable = [
        'measurements_apperals_id',
        'check_points_id',
        'sizes_id',
        'tolerances',
        'spec'
    ];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public $timestamps = false;

}
