<?php

namespace App\Models\Inspector\ProductDevelopment\Record\Measurement;

use App\Models\Configure\Color;
use App\Models\Configure\Size;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reference extends Model
{
    use HasFactory;
    use softDeletes;
    public $table = 'develop_product_record_header_measure';
    protected $fillable = ['header_id',
        'measurement_profile_id',
        'size','color',
        'item_checked'];
    public function item(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Item::class, 'header_id');
    }
    public function sizes(){
        return $this->belongsTo(Size::class,'size');
    }
    public function colors(){
        return $this->belongsTo(Color::class,'color');
    }

}
