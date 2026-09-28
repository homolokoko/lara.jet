<?php

namespace App\Models\Inspector\Cutting;

use App\Models\Configure\Cutting\Checkpoint;
use App\Models\Inspector\Cutting\Binaudit\Header as BinauditHeader;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecapCabinAudit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cutting_recap_cabinAudit';
    protected $fillable = [
        'cutting_binAudit_header_id',
        'cutting_checkpoint_id',
        'cutting_recap_id'
    ];
    public $timestamps = false;

    public function headers()
    {
        return $this->belongsTo(BinauditHeader::class, 'cutting_binAudit_header_id');
    }
    public function checkPoint()
    {
        return $this->belongsTo(Checkpoint::class, 'cutting_checkpoint_id');
    }
}
