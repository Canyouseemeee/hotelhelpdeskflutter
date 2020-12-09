<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IssuesLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    public function index(){
        $issuesLogs = IssuesLogs::all();
        $issueschange = DB::table('issues')->where([['Statusid', 1], ['Date_In', '!=', now()->toDateString()]])->update(['Statusid' => 3]);
        return view('admin.history.index',compact([['issuesLogs'],['issueschange']]));
    }
}
