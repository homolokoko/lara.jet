<?php

namespace App\Models\Inspector\Endline\Measure\Item;

use App\Models\Inspector\Endline\Measure\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    use HasFactory;
    public $table = "endline_measure_repair_header";
    protected $fillable = ['item_id', 'qrcode'];
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    function chart()
    {
        return $this->hasMany(CaseChart::class, 'header_id');
    }
    function item()
    {
        return $this->belongsTo(Item::class, "item_id");
    }
    function profile()
    {
        return $this->hasOneDeepFromRelations(
            $this->item(),
            (new item)->header()
        );
    }
    function scopeQrcode($q, $v)
    {
        return $q->where('qrcode', '=', $v);
    }
}
