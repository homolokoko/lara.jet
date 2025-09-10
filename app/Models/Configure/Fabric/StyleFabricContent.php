<?php

namespace App\Models\Configure\Fabric;

use App\Models\Configure\Styles;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class StyleFabricContent extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $table = 'fabric_contents_recipe_style';
    protected $fillable = ['style_id','recipe_id','special_request'];
    protected $appends = ['request'];
    protected $casts = ['special_request'=>'float'];

    function style(){
        return $this->belongsTo(Styles::class,'style_id');
    }
    function recipe(){
        return $this->belongsTo(RecipeHumidity::class,'recipe_id');
    }
    function content(){
        return $this->hasManyDeepFromRelations($this->recipe(),
            (new RecipeHumidity)->ingredients()
        );
    }
    function getRequestAttribute(){
        return ($this->specialRequest) ? $this->specialRequest : $this->recipe->humidity_require;
    }
}
