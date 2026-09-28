<?php

namespace App\Models\Configure\PDShrinkage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Configure;

class Before extends Model
{
    use HasFactory;
    protected $table = 'pd_shrinkage_before';
    protected $fillable = [
        'size_id',
        'pd_shrinkage_header_id',
        'part_name',
        'buyer_expected',
        'before_cutting',
        'remark'
    ];
    public $timestamps = false;

    public function size()
    {
        return $this->belongsTo(Configure\Size::class, 'size_id');
    }

    public function after()
    {
        return $this->hasOne(After::class, 'pd_shrinkage_before_id', 'id');
    }

    public function afters()
    {
        return $this->hasMany(After::class, 'pd_shrinkage_before_id', 'id');
    }
    public function getIsAdminAttribute()
    {
        return $this->attributes['admin'] === 'yes';
    }
}
