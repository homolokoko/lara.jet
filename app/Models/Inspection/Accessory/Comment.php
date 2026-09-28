<?php

namespace App\Models\Inspector\Accessory;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    use HasFactory;
    public $table = "accessory_comment";
    protected $fillable = ['accessory_defect_id', 'comment', 'comment_by', 'image', 'is_resolved'];

    public function commentBy()
    {
        return $this->belongsTo(User::class, 'comment_by');
    }
    public function getImageAttribute($value)
    {
        return ($value) ? Storage::disk('accessory')->url($value) : '';
    }
    public function getCommentByAttribute($value)
    {
        return ($value) ? User::get()->find($value)->name : '';
    }
    public function getIsResolvedAttribute($value)
    {
        return ($value) ? 'Resolved' : 'Unresolved';
    }
}
