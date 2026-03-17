<?php

namespace App\Models\Inspector\Endline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairLog extends Model
{
    use HasFactory;
    public $table = 'insp_endline_repair_log';
    protected $fillable = ['insp_endline_repair_id','workstation_id','is_pass','is_damage','is_repair'];
}
