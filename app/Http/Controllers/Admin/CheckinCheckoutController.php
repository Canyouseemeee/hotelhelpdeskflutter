<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IssuesCheckin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinCheckoutController extends Controller
{
    public function index(){
        $issuesCheckin = DB::table('issues_checkin')
        ->select('*')
        ->join('issues', 'issues.Issuesid', '=', 'issues_checkin.Issuesid')
        ->whereIn('issues_checkin.Status',array(2,3))
        ->where('issues.Statusid','!=',2)
        ->orderBy('Checkinid','DESC')
        ->get();
        return view('admin.checkin-checkout.index',compact('issuesCheckin'));
    }
}
