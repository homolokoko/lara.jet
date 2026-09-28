<?php

namespace App\Models\Configure\Symmetric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupVersion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'symmetric_group_version';
    protected $fillable = ['symmetric_header_id', 'version_id'];

    public function version()
    {
        return $this->belongsTo(\App\Models\Configure\Version::class, 'version_id');
    }

    public function symmetricDetail()
    {
        return $this->hasMany(Detail::class, 'symmetric_version_id', 'id');
    }

    public function measureProfileDetail()
    {
        return $this->hasManyThrough(
            \App\Models\Configure\Measure\Profile\Detail::class,
            Detail::class,
            'symmetric_group_version_id',
            'id',
            'id',
            'measure_profile_detail_id',
        );
    }
}
