<?php

namespace Modules\ProcessQCModule\Entities\Inspection\Endline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemEntity extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'insp_endline_item';
    protected $fillable = ['insp_endline_profile_id','sizes_id','color_id','is_pass','is_repair','item_no'];

    protected static function newFactory()
    {
        return \Modules\ProcessQCModule\Database\factories\Inspection\Endline\ItemEntityFactory::new();
    }
}
