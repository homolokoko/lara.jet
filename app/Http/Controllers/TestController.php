<?php

namespace App\Http\Controllers;

use App\Models\Configure\Styles;
use Illuminate\Http\Request;

class TestController extends Controller
{

    //
    function query()
    {
        return view('test');
    }
}
