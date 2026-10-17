<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CountryCatalog\Entities\{Street,City,State,Zip};
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    public $timestamps = false;
    protected $table = 'users_adress';
    protected $fillable = ['user_id','street_id','is_current'];

    public function street()
    {
        return $this->belongsTo(Street::class,'street_id');
    }

    public function city()
    {
        return $this->hasOneDeepFromRelations(
            $this->street(),
            (new Street)->city()
        );
    }

    public function state()
    {
        return $this->hasOneDeepFromRelations(
            $this->city(),
            (new City)->state()
        );
    }

    public function zip()
    {
        return $this->hasOneDeepFromRelations(
            $this->state(),
            (new State)->zip()
        );
    }

    public function country()
    {
        return $this->hasOneDeepFromRelations(
            $this->zip(),
            (new Zip)->country()
        );
    }
}
