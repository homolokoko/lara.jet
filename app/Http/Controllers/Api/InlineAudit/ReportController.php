<?php

namespace App\Http\Controllers\Api\InlineAudit;

use App\Http\Controllers\Controller;
use App\Library\DateRange;
use App\Models\Inspector\Inline\Profile;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //

    public function summary($mode)
    {
        $data = Profile::query()
            ->with([])
            ->whereBetween('created_at',[DateRange::start('2022-09-21'),DateRange::end('2022-09-22')])->get();
        return response()->json($data);
    }
}
