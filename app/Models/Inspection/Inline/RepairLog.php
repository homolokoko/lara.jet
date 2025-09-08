<?php

namespace App\Models\Inspector\Inline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairLog extends Model
{
    use HasFactory;
    public $table = 'insp_inline_repair_log';
    protected $fillable = ['insp_inline_repair_id','is_pass','is_damage','is_repair'];

    public function comment(){
        return $this->hasOne(RepairComment::class,'insp_inline_repair_log_id');
    }
}
