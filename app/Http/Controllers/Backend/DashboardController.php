<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DB;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['total_donations'] = DB::table('customers')->sum('amount');
        $data['avg_donations'] = DB::table('customers')->avg('amount');
        $data['total_users'] = DB::table('users')->count();
        $data['total_teams'] = DB::table('teams')->count();
        return view('backend.dashboard')->with($data);
    }
}
