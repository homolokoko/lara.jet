<?php

namespace App\Models\Staff;

use Dom\Entity;
use Modules\CountryCatalog\Entities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'staff_address';
    protected $fillable = ['user_id', 'street_id', 'city_id', 'state_id', 'zip_id', 'is_current'];

    public function street()
    {
        return $this
            ->belongsTo(Entities\Street::class,'street_id');
    }

    public function city()
    {
        return $this
            ->belongsTo(Entities\City::class,'city_id');
    }

    public function state()
    {
        return $this
            ->belongsTo(Entities\State::class,'state_id');
    }

    public function zip()
    {
        return $this
            ->belongsTo(Entities\Zip::class,'zip_id');
    }
}
