<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{

    public  function index()
    {
        return view('admin.dashboard');
    }
}
