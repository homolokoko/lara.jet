<?php

namespace App\Models\Configure\Cutting;

use App\Models\Configure\Styles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StylePanel extends Model
{
    use HasFactory;
    protected $fillable = ['styles_id','panel_id','image'];
    protected $table="styles_cutting_panel";
    protected $hidden = ['styles_id','panel_id'];
    public $timestamps = false;

    public function getImageAttribute($data){
        return ($data)? Storage::disk('cuttingPanel')->url($data): null ;
    }
    public function panel(){
        return $this->hasOne(Panel::class,'id','panel_id');
    }
    
}
