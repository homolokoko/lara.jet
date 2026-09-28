<?php

namespace App\Models\Inspector\Inline;

use App\Models\Configure\Action;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Comment extends Model
{
    use HasFactory;
    public $table = 'insp_inline_comment';
    protected $fillable = [
        'insp_inline_item_id',
        'comment',
        'commenter_id',
        'actions_id' ];
    public function Actions(){
        return $this->belongsTo(Action::class,'actions_id');
    }
    public function Commenter(){
        return $this->belongsTo(User::class,'commenter_id');
    }
}
