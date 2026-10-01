<?php

namespace App\Models\ScoreBullet;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'score_bullet_subjects';
    protected $fillable = ['subject','full_marks','actual_marks','score_bullet_header_id'];

    public function header()
    {
        return $this->belongsTo(Header::class,'score_bullet_header_id');
    }
}
