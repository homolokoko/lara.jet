<?php
namespace App\Models\Inspector\Inline;

use Illuminate\Database\Eloquent\Model;
use App\Models\Configure;

class CheckList extends Model{
    protected $table = 'insp_inline_check_list';
    protected $fillable = [
        'check_list_id', 'profile_id','is_pass'
    ];
    public $timestamps = false;
    protected $appends = ['status'];

    function name() {
        return $this->belongsTo(Configure\Inline\CheckList::class, 'item_id', 'id');
    }
    function getStatusAttribute() {
        return ($this->is_pass === 1) ? 'Check & Pass' : ($this->is_pass === 0) ? 'Check & Fail' : 'Skip';

    }
}

