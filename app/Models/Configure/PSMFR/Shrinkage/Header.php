<?php

namespace App\Models\Configure\PSMFR\Shrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;
    protected $table = 'psmfr_shrinkage_header';
    protected $fillable = ['buyer_id','styles_id', 'color_id', 'shrinkage_height', 'shrinkage_width','measurement_profile_id'];

    public function detail(){
        return $this->hasMany('App\Models\Configure\PSMFR\Shrinkage\Detail', 'header_id');
    }
    function buyer(){
        return $this->belongsTo('App\Models\Configure\Buyer', 'buyer_id');
    }
    function style(){
        return $this->belongsTo('App\Models\Configure\Style', 'styles_id');
    }
    function color(){
        return $this->belongsTo('App\Models\Configure\Color', 'color_id');
    }
}




