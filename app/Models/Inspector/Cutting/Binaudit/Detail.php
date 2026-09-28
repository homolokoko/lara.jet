<?php

namespace App\Models\Inspector\Cutting\Binaudit;

use App\Models\Configure\Cutting\Checkpoint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table="cutting_binAudit_checklist";
    protected $fillable = ['cutting_binAudit_header_id','cutting_checkpoint_id','is_correct'];
    public $timestamps = false;

    public function header(){
        return $this->belongsTo(Header::class, 'cutting_binAudit_header_id');
    }
    public function checkpoint(){
        return $this->belongsTo(Checkpoint::class, 'cutting_checkpoint_id');
    }

}
