<?php

namespace App\Models\Configure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubjectTitle extends Model
{
    use HasFactory;

    protected $table = 'subject_title';
    protected $fillable = ['name'];

    public $appends = ['official_name'];

    public function getOfficialNameAttribute()
    {
        return Str::of($this->name)->replace('_',' ')->upper();
    }
}
