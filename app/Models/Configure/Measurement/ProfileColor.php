<?php

namespace App\Models\Configure\Measurement;

use App\Models\Configure\Color;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileColor extends Model
{
    use HasFactory;
    protected $table="measurement_profile_color";
    protected $fillable = ['measurement_profile_id', 'color_id'];

    public function color(){
        return $this->belongTo(Color::class,'color_id');
    }
}
