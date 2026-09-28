<?php

namespace App\Models\StyleProfile;

use App\Models\Style;
use App\Models\Size as Root;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'style_profile_size';

    public function profile()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_profile_id'
            );
    }

    public function size()
    {
        return $this
            ->belongsTo(
                Root::class,
                'size_id'
            );
    }
}
