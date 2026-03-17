<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class DefectsTopicTitle extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = "defects_topic_title";
    protected $fillable =['name'];

    public function DefectTypeCategoryTopic(){
       return $this->HasMany(DefectsTypeCategoryTopic::class,'defects_topic_title_id');
    }
    public function Defects(){
        return $this->hasManyThrough(
            Defects::class,
            DefectsTypeCategoryTopic::class,
           'defects_topic_title_id',
           'id',
            'id',
            'defects_id'
        );
    }
}
