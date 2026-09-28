<?php

namespace App\Models\Inspector\Endline\Measure\Defect;

use App\Models\Configure\WorkstationLocate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    public $table = "endline_measure_defect_header";
    protected $fillable = ['locate_id', 'defect_found', 'report_date', 'inspector_id'];

    public function record()
    {
        return $this->hasMany(Record::class, 'header_id');
    }
    public function locate()
    {
        return $this->belongsTo(WorkstationLocate::class, 'locate_id');
    }
}
