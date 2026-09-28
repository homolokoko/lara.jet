<?php

namespace App\Models\Inspector\Inline;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class RepairComment extends Model
{
    use HasFactory;
    public $table = 'insp_inline_repair_comment';
    protected $fillable = ['insp_inline_repair_log_id','comment','inspector_id'];

    public function inspector(){
        return $this->belongsTo(User::class,'inspector_id');
    }
    public function log(){
        return $this->belongsTo(RepairLog::class,'insp_inline_repair_log_id');
    }
}
