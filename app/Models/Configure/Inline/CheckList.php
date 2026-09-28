<?php
namespace App\Models\Configure\Inline;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CheckList extends Model{

    use SoftDeletes;
    protected $table = 'inline_check_list';
    protected $fillable = ['name'];

    protected $appends = [
        'readable_name',
    ];
    public function scopeFilterDeleted($query, $value)
    {
        return ($value == 'Yes') ? $query->whereNotNull('deleted_at') : $query->whereNull('deleted_at') ;
    }

    public function getReadableNameAttribute()
    {
        return Str::of($this->name)->snake()->replace('_', ' ')->upper();
    }

}
