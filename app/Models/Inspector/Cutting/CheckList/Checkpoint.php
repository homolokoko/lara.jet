<?php

namespace App\Models\Inspector\Cutting\CheckList;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Cutting\Checkpoint as ConfigCuttingCheckpoint;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checkpoint extends Model
{
    use HasFactory;
    public $table="cutting_checklist_checkpoint";
    protected $fillable = ['cutting_header_id','cutting_checkpoint_id','is_correct'];
    public $timestamps = false;
    use SoftDeletes;

    public function checkpoint(){
        return $this->belongsTo(ConfigCuttingCheckpoint::class,'cutting_checkpoint_id');
    }
}
