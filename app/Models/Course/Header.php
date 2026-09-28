<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Header extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasRelationships;

    protected $table = 'course';
    protected $fillable = ['name'];

    public function detail()
    {
        return $this->hasOne(Detail::class,'course_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class,'course_id');
    }

    public function subjectTiltes()
    {
        return $this->hasManyDeepFromRelations($this->subjects(),(new Subject)->title());
    }
}
