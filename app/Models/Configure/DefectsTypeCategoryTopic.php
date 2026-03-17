<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefectsTypeCategoryTopic extends Model
{
    use HasFactory;
    public $table = "defects_type_catgory_topic";
    protected $fillable = ['defects_id', 'defects_type_title_id', 'defect_category_title_id', 'defects_topic_title_id'];
    public $timestamps = true;

    public function defect()
    {
        return $this->belongsTo(Defects::class, 'defects_id');
    }
    public function defectType()
    {
        return $this->belongsTo(DefectsTypeTitle::class, 'defects_type_title_id');
    }
    public function defectCategory()
    {
        return $this->belongsTo(DefectsCategoryTitle::class, 'defect_category_title_id');
    }
    public function defectTopic()
    {
        return $this->belongsTo(DefectsTopicTitle::class, 'defects_topic_title_id');
    }
    public function scopeSewing($q)
    {
        return $q->where(['defects_type_title_id' => 1]);
    }
}
