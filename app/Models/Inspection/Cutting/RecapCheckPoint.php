<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\Cutting\Checkpoint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecapCheckPoint extends Model
{
    use HasFactory;
    protected $table = 'cutting_recap_checkpoint';
    protected $fillable = ['cutting_checkpoint_id','cutting_recap_id'];
    public $timestamps = false; 

    public function name(){
        return $this->belongsTo(Checkpoint::class,'cutting_checkpoint_id');
    }

}
