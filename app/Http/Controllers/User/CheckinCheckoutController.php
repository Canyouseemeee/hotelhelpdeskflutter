<?php

namespace App\Http\Controllers\User;

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
        ->where([['issues_checkin.Status',2],['issues.Statusid','!=',2]])
        ->orderBy('Checkinid','DESC')
        ->get();
        return view('user.checkin-checkout.index',compact('issuesCheckin'));
    }
}
