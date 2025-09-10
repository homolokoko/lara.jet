<?php

namespace App\Models\Configure\Style;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WashType extends Model
{
    use HasFactory;
    protected $table = 'style_wash_type';
    protected $fillable = ['styles_id','wash_type_id'];
    public $timestamps = false;

    function style(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo('App\Models\Configure\Style\Style','styles_id');
    }

    function washType()
    {
        return $this->belongsTo('App\Models\Configure\WashType','wash_type_id');
    }
}
