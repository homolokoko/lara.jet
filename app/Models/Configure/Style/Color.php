<?php

namespace App\Models\Configure\Style;

use App\Models\Configure\Color as ConfigureColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'style_profile_color';
    protected $fillable = ['style_profile_id','color_id'];

    public function name(){
        $this->belongsTo(ConfigureColor::class,'color_id' );
    }
}
