<?php

namespace App\Http\Controllers;

use App\Models\Configure\Styles;
use Illuminate\Http\Request;
use App\Models\Student\Profile;

class TestController extends Controller
{

    //
    function query()
    {
         $datatable = Profile::get();
         return response()->json($datatable->map(fn($i)=>['mother_info'=>$i->motherInfo->first()]));
        return view('test');
    }
}
