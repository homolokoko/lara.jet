<?php

namespace App\Models\StyleProfile;

use App\Models\Style;
use App\Models\Color as Root;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $table = 'style_profile_color';

    public function profile()
    {
        return $this
            ->belongsTo(
                Style::class,
                'style_profile_id'
            );
    }

    public function color()
    {
        return $this
            ->belongsTo(
                Root::class,
                'color_id'
            );
    }
}
