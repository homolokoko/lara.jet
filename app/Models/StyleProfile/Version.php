<?php

namespace App\Models\StyleProfile;

use App\Models\Style;
use App\Models\Version as Root;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;
    protected $table = 'style_profile';

    public function style()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_id'
            );
    }

    public function version()
    {
        return $this
            ->belongsTo(
                Root::class,
                'version_id'
            );
    }
}
