<?php

namespace App\Models\Auditor\Inspection;

use App\Models\Configure\Measurement\Profile;
use App\Models\Configure\PurchaseOrders;
use App\Models\Configure\StyleColor;
use App\Models\Configure\Styles;
use App\Models\Configure\StyleSize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\CountryController;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class StyleInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $table = 'inspection_style_information';
    protected $fillable = [
        'header_id', 'style_id', 'purchase_order_id', 'production_desc',	'destination_country','destination_city'
    ];
    protected $appends = ['country'];

    public function style()
    {
        return $this->belongsTo(Styles::class, 'style_id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrders::class, 'purchase_order_id');
    }
    public function quantity()
    {
        return $this->hasMany(Quantity::class, 'style_information_id');
    }
    public function getCountryAttribute($v)
    {
        $country = new CountryController();
        return $country->getCountry($this->destination_country);
    }
    public function size()
    {
        return $this->hasManyDeepFromRelations(
            $this->style(),
            (new Styles())->profileSize()
        )->distinct();
    }
    public function color()
    {
        return $this->hasManyDeepFromRelations(
            $this->style(),
            (new Styles())->profileColor()
        )->distinct();
    }

    public function scopeHeaderId($query, $header_id)
    {
        return $query->where('header_id', $header_id);
    }
    public function measurement()
    {
        return $this->hasManyDeepFromRelations(
            $this->style(),
            (new Styles())->measureCheckPoint()
        );
    }

    public function colorWithWIP()
    {
        return $this->hasMany(StyleColor::class, 'style_id', 'style_id');
    }

    public function wipColor()
    {
        return $this->hasManyDeepFromRelations($this->colorWithWIP(), (new StyleColor)->colors());
    }

    public function wipColorWithWIP()
    {
        return $this->hasMany(StyleSize::class, 'style_id', 'style_id');
    }

    public function wipSize()
    {
        return $this->hasManyDeepFromRelations($this->wipColorWithWIP(), (new StyleSize)->sizes());
    }
}
