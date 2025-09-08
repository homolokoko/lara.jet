<?php

namespace App\Models\Inspector\PSMFR;

use App\Models\Configure\PSMFR\Process;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'psmfr_items';
    protected $fillable = ['header_id', 'process_id'];

    function process(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Process::class,'process_id');
    }
    function record(){
        return $this->hasMany(Chart::class, 'item_id');
    }


}
