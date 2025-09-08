<?php

namespace App\Models\Inspector\AfterWash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReworkRecord extends Model
{
    use SoftDeletes;

    protected $table = 'insp_afterwash_item_rework_record';

    protected $fillable = [
        'locate_id',
        'inspector_id',
        'is_pass',
        'item_id',
    ];
}
