<?php

namespace App\Models\Inspector\PSMFR;

use App\Models\Configure\Buyers;
use App\Models\Configure\Color;
use App\Models\Configure\Size;
use App\Models\Configure\Styles;
use App\Models\Configure\Version;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Configure\Measure;
class Header extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    protected $table = 'psmfr_header';
    protected $fillable = [
        'buyer_id', 'style_id', 'color_id', 'sizes_id', 'measure_profile_id'
    ];

    function buyer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Buyers::class, 'buyer_id');
    }
    function style():  \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Styles::class, 'style_id');
    }
    function color():  \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class,'color_id');
    }
    function size(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Size::class, 'sizes_id');
    }
    function item(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Item::class, 'header_id');
    }
    function inspector(){
        return $this->hasMany(Inspector::class, 'header_id');
    }
    function measureProfile(){
        return $this->belongsTo(Measure\Profile\Header::class, 'measure_profile_id');
    }
    function measureVersion(){
        return $this->hasOneDeepFromRelations(
            $this->measureProfile(), (new Measure\Profile\Header)->version()
        );
    }
    function version()
    {
        return $this->belongsTo(Version::class, 'measure_profile_id',);
    }
    function sketch(){
        return $this->hasManyDeepFromRelations($this->style(), (new Styles)->profileAppparel());
    }
    function washType()
    {
        return $this->hasOneDeepFromRelations($this->style(), (new Styles)->washTypeTitle());

    }




}
