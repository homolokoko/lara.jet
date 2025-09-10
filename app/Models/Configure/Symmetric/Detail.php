<?php

namespace App\Models\Configure\Symmetric;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    // protected $primaryKey = 'id';
    protected $table = 'symmetric_detail';
    protected $fillable = [
        'symmetric_header_id',
        'symmetric_version_id',
        'symmetric_group_version_id',
        'measure_profile_detail_id'
    ];

    public function header()
    {
        return $this->belongsTo(Header::class, 'symmetric_header_id');
    }
    public function symmetricVersion()
    {
        return $this->belongsTo(Version::class, 'symmetric_version_id');
    }
}
