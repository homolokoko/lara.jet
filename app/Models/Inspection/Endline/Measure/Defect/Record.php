<?php

namespace App\Models\Inspector\Endline\Measure\Defect;

use App\Models\Configure\CheckPoints as ConfigureCheckPoints;
use App\Models\Configure\Color;
use App\Models\Configure\Defect\Cause;
use App\Models\Configure\Defects;
use App\Models\Configure\Size;
use App\Models\Configure\Style\CheckPoint;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Record extends Model
{
    use HasFactory;
    use HasRelationships;
    public $table = "endline_measure_defect_record";
    protected $fillable = [
        'header_id', 'defect_id', 'checkpoint_id', 'color_id', 'size_id',
        'count',
        'style_profile_apparel',
        'style_apparel_id',
        'cause_id',
        'image'
    ];
    protected $appends = ['imageDisplay'];
    function defect(){
        return $this->belongsTo(Defects::class, 'defect_id');
    }
    function checkpoint()
    {
        return $this->belongsTo(ConfigureCheckPoints::class, 'checkpoint_id');
    }
    function cause(){
        return $this->belongsTo(Cause::class, 'cause_id');
    }

    function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
    function size()
    {
        return $this->belongsTo(Size::class, 'size_id');

    }
    function tracking(){
        return $this->hasOne(Tracking::class, 'measure_defect_record_id');
    }
    function header(){
        return $this->belongsTo(Header::class, 'header_id');
    }

    function locate()
    {
        return $this->hasOneDeepFromRelations(
            $this->header(),
            (new header())->locate()
        );
    }
    function actionTaken()
    {
        return $this->hasOneDeepFromRelations(
            $this->tracking(),
            (new Tracking())->actionTaken()
        );
    }
    function getImageDisplayAttribute()
    {
        if(!$this->image){
            return URL::asset('/noimage.png');
        }
       $exist= Storage::disk('measurementDefect')->exists($this->image);
       return ($exist)? Storage::disk('measurementDefect')->url($this->image) : URL::asset('/noimage.png');
    }
    public function scopeCase($q,$v){
        return $q->where('id','=',$v);
    }

}
