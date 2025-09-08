<?php

namespace App\Models\Configure\Measurement;

use App\Models\Configure\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileSizes extends Model
{    
    protected $table="measurement_profile_sizes";
    protected $fillable = ['measurement_profile_id', 'sizes_id'];

    public function size(){
        return $this->belongTo(Size::class,'sizes_id');
    }

}
