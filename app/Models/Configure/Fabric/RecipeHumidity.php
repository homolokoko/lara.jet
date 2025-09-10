<?php

namespace App\Models\Configure\Fabric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeHumidity extends Model
{
    use HasFactory;
    public $table = 'fabric_content_recipe_humidity';
    protected $fillable = ['combination','humidity_require'];
    protected $appends = ['name'];

    function ingredients(){
        return $this->hasMany(RecipeHumidityDetail::class,'recipe_humidity_id');
    }
    function getNameAttribute(){
        if($this->ingredients->count() > 1){
            return $this->ingredients->sortByDesc('percent')->pluck('name')->implode(', ');
        }
        return $this->ingredients->pluck('name')->implode(', ');
    }

}
