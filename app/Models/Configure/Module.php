<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Configure\Module\Locates;

class Module extends Model
{
    use HasFactory;

    protected $table = 'module';
    protected $fillable = [
        'name'
    ];

    function locates(){
        return $this->hasMany(Locates::class,'module_id');
    }
}
