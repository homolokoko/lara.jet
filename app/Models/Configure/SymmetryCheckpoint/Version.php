<?php

namespace App\Models\Configure\SymmetryCheckpoint;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Configure;
use App\Models\Configure\SymmetryCheckpoint;

class Version extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'symmetry_checkpoint_version';
    protected $fillable = ['symmetry_checkpoint_id', 'version_id'];

    public function version()
    {
        return $this->hasOne(Configure\Version::class, 'id', 'version_id');
    }

    public function symmetryHeader()
    {
        return $this->belongsTo(SymmetryCheckpoint\Header::class, 'symmetry_checkpoint_id');
    }
}
