<?php

namespace App\Models\Inspector\Recovery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InlineAudit\Packing\ItemDefect;

class InlinePacking extends Model
{
    use HasFactory;
    public $table = "recovery_inline_packing";
    protected $fillable = [
        'repair_id'
    ];
    public $timestamps = false;

    function repair()
    {
        return $this->belongsTo(ItemDefect::class, 'repair_id');
    }
    function defect()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new ItemDefect)->defect()
        );
    }
    function checkpoint()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new ItemDefect)->checkpoint()
        );
    }

    function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->repair(),
            (new ItemDefect)->profile()
        );
    }
}
