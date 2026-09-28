<?php

namespace App\Models\Configure\Fabric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeHumidityDetail extends Model
{
    use HasFactory;
    public $table = 'fabric_content_recipe_humidity_detail';
    protected $fillable = ['recipe_humidity_id','fabric_contents_detail'];
    function contentDetail(){
        return $this->belongsTo(ContentDetail::class,'fabric_contents_detail');
    }
    protected $appends = ['name','percent'];

    function getNameAttribute(){

        return \Str::of( $this->contentDetail->percent)->append('% ')->append($this->contentDetail->getContent->name);
    }
    function getPercentAttribute(){
        return $this->contentDetail->percent;
    }

}
