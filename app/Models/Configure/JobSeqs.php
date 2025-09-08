<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

use App\Models\Configure\Style\Profile as StyleProfile;

class JobSeqs extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $fillable = ['no', 'name', 'styles_id', 'style_profile_id'];
    public $translatedAttributes = ['name'];


    public function styleProfile()
    {
        return $this->belongsTo(StyleProfile::class, 'style_profile_id');
    }
}
