<?php

namespace App\Models\Configure;

use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Configure\CheckPoints;
use App\Http\Controllers\Library\SvgController;

class StylesApperals extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Cloneable;

    private SvgController $svg_controller;
    protected $cloneable_file_attributes = ['image'];

    protected $fillable =['styles_id','name','image','apperals_id','editable'];


    public function styles()
    {
        return $this->belongsTo(Styles::class, 'styles_id');
    }

    public function apperals()
    {
        return $this->belongsTo(Apperal::class, 'apperals_id');
    }

    public function checkpoint()
    {
        return $this->hasMany(StylesApperalsCheckPoint::class, 'styles_apperals_id');
    }

    public function apperalscheckpoint()
    {
        return $this->hasManyThrough(
            CheckPoints::class,
            StylesApperalsCheckPoint::class,
            'styles_apperals_id',
            'id',
            'id',
            'check_points_id'
        );
    }



    /*return $this->hasOneThrough(
        Order::class,
        Product::class,
        'supplier_id', // Foreign key on products table...
        'product_id', // Foreign key on orders table...
        'id', // Local key on suppliers table...
        'id' // Local key on products table...
    );*/

    public function getEditableAttribute($value)
    {
        $exist = Storage::disk('styleApperal')->exists($value);
        $data =  ($exist)? Storage::disk('styleApperal')->get($value): '';
        return  $data;
    }

    public function getImageAttribute($value)
    {
        $exist = Storage::disk('styleApperal')->exists($value);
        $data = '/no-image.png';
        if ($exist) {
            $image = Storage::disk('styleApperal')->get($value);
            $this->svg_controller = new SvgController();
            $data = $this->svg_controller->processSvg($image);
        }
        return  $data ;
    }

    public function replicateRow()
    {
        dd('hihi');
    }
}
