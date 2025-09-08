<?php

namespace App\Models\Configure\Cutting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Storage;

class Panel extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $table='cutting_panel';
    public $fillable=['image'];
    public $translatedAttributes = ['name'];
    public $timestamps = false;
    public $appends = ['image_url'];


    public function image(){
        return $this->hasMany(StylePanel::class,'panel_id');
    }
    public function scopeImage($q,$styleId){
        return $q->whereRelation('image','styles_id', $styleId);
    }

    function patternMeasure(){
        return $this->hasMany(\App\Models\Inspector\Cutting\Measure\PanelPattern::class, 'cutting_panel_id');
    }

    public function getImageUrlAttribute()
    {
        return Storage::disk('cuttingPanel')->url($this->image);
    }


}
