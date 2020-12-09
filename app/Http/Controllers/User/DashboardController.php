<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Issues;
use App\Models\Issuesstatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //Data
        $data = DB::table('issues')->where('issues.Date_In', now()->toDateString())->count();
        $data2 = DB::table('issues')->where([
            ['issues.Statusid', 1],
            ['issues.Date_In', now()->toDateString()]
        ])->count();
        $data3 = DB::table('issues')->where('issues.Statusid', 3)->count();
        $data4 = DB::table('issues')->where([
            ['issues.Statusid', 2],
            ['issues.Date_In', now()->toDateString()]
        ])->count();

        //Donut
        $datalabel = "'News','Defer','Closed'";
        $datatotal = "" . $data2 . "," . $data3 . "," . $data4 . "";

        //Column HW
        $databar = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Install'], ['Name', 'PC']])
            ->count();
        $databar2 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Install'], ['Name', 'Printer']])
            ->count();
        $databar3 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Fix'], ['Name', 'PC']])
            ->count();
        $databar4 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Fix'], ['Name', 'Printer']])
            ->count();
        $databar5 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Move'], ['Name', 'PC']])
            ->count();
        $databar6 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Move'], ['Name', 'Printer']])
            ->count();
        $datattbar = "'Install'," . $databar . "," . $databar2 . "";
        $datattbar2 = "'Fix'," . $databar3 . "," . $databar4 . "";
        $datattbar3 = "'Move'," . $databar5 . "," . $databar6 . "";

        //Column SW
        $databarsw = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'HIS']])
            ->count();
        $databarsw1 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'RROP']])
            ->count();
        $databarsw2 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'SAP']])
            ->count();
        $databarsw3 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'Cagent']])
            ->count();
        $databarsw4 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'Windows']])
            ->count();
        $databarsw5 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'Adobe']])
            ->count();
        $databarsw6 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'HIS']])
            ->count();
        $databarsw7 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'RROP']])
            ->count();
        $databarsw8 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'SAP']])
            ->count();
        $databarsw9 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'Cagent']])
            ->count();
        $databarsw10 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'Windows']])
            ->count();
        $databarsw11 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'Adobe']])
            ->count();


        $datattbarsw = "'Install'," . $databarsw . "," . $databarsw1 . "," . $databarsw2 . "
        ," . $databarsw3 . "," . $databarsw4 . "," . $databarsw5 . "";
        $datattbarsw2 = "'Fix'," . $databarsw6 . "," . $databarsw7 . "," . $databarsw8 . "
        ," . $databarsw9 . "," . $databarsw10 . "," . $databarsw11 . "";

        //Bar Month
        $datamonthbar = DB::table('issues')->whereBetween('Date_In', ['2020-07-01', '2020-07-31'])->count();
        $datamonthbar1 = DB::table('issues')->whereBetween('Date_In', ['2020-08-01', '2020-08-31'])->count();
        $datamonthbar2 = DB::table('issues')->whereBetween('Date_In', ['2020-09-01', '2020-09-30'])->count();
        $datamonthbar3 = DB::table('issues')->whereBetween('Date_In', ['2020-10-01', '2020-10-31'])->count();
        $datamonthbar4 = DB::table('issues')->whereBetween('Date_In', ['2020-11-01', '2020-11-30'])->count();
        $datamonthbar5 = DB::table('issues')->whereBetween('Date_In', ['2020-12-01', '2020-12-31'])->count();
        $datatotalmonthbar = "" . $datamonthbar . "," . $datamonthbar1 . "," . $datamonthbar2 . "," . $datamonthbar3 . "
        ," . $datamonthbar4 . "," . $datamonthbar5 . "";

        $issuesstatus = Issuesstatus::all();
        $issueschange = DB::table('issues')->where([['Statusid', 1], ['Date_In', '!=', now()->toDateString()]])->update(['Statusid' => 3]);
        // dd($issueschange);
        $fromdate = null;
        $todate = null;
        return view('user.dashboarduser', compact(
            ['issuesstatus'],
            ['issueschange'],
            ['data'],
            ['data2'],
            ['data3'],
            ['data4'],
            ['datalabel'],
            ['datatotal'],
            ['datatotalmonthbar'],
            ['datattbar'],
            ['datattbar2'],
            ['datattbar3'],
            ['datattbarsw'],
            ['datattbarsw2'],
            ['fromdate'],
            ['todate']

        ));
    }

    public function getReport(Request $request)
    {
        $fromdate = $request->input('fromdate');
        $todate = $request->input('todate');
        //Data
        $data = DB::table('issues')
            ->whereBetween('Date_In', [$fromdate, $todate])
            ->count();
        $data2 = DB::table('issues')->where([
            ['issues.Statusid', 1],
            ['issues.Date_In', now()->toDateString()]
        ])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])->count();
        $data3 = DB::table('issues')->where('issues.Statusid', 3)
            ->whereBetween('issues.Date_In', [$fromdate, $todate])->count();
        $data4 = DB::table('issues')->where('issues.Statusid', 2)
            ->whereBetween('issues.Date_In', [$fromdate, $todate])->count();

        //Donut
        $datalabel = "'News','Defer','Closed'";
        $datatotal = "" . $data2 . "," . $data3 . "," . $data4 . "";

        //Column HW
        $databar = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Install'], ['Name', 'PC']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databar2 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Install'], ['Name', 'Printer']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databar3 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Fix'], ['Name', 'PC']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databar4 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Fix'], ['Name', 'Printer']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databar5 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Move'], ['Name', 'PC']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databar6 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'HW'], ['SubTrackName', 'Move'], ['Name', 'Printer']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $datattbar = "'Install'," . $databar . "," . $databar2 . "";
        $datattbar2 = "'Fix'," . $databar3 . "," . $databar4 . "";
        $datattbar3 = "'Move'," . $databar5 . "," . $databar6 . "";

        //Column SW
        $databarsw = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'HIS']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw1 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'RROP']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw2 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'SAP']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw3 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'Cagent']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw4 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'Windows']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw5 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Install'], ['Name', 'Adobe']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw6 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'HIS']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw7 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'RROP']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw8 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'SAP']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw9 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'Cagent']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw10 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'Windows']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();
        $databarsw11 = DB::table('issues')
            ->join('issues_tracker', 'issues_tracker.Trackerid', '=', 'issues.Trackerid')
            ->where([['TrackName', 'SW'], ['SubTrackName', 'Fix'], ['Name', 'Adobe']])
            ->whereBetween('issues.Date_In', [$fromdate, $todate])
            ->count();


        $datattbarsw = "'Install'," . $databarsw . "," . $databarsw1 . "," . $databarsw2 . "
        ," . $databarsw3 . "," . $databarsw4 . "," . $databarsw5 . "";
        $datattbarsw2 = "'Fix'," . $databarsw6 . "," . $databarsw7 . "," . $databarsw8 . "
        ," . $databarsw9 . "," . $databarsw10 . "," . $databarsw11 . "";

        //Bar Month
        $datamonthbar = DB::table('issues')->whereBetween('Date_In', ['2020-07-01', '2020-07-31'])->count();
        $datamonthbar1 = DB::table('issues')->whereBetween('Date_In', ['2020-08-01', '2020-08-31'])->count();
        $datamonthbar2 = DB::table('issues')->whereBetween('Date_In', ['2020-09-01', '2020-09-30'])->count();
        $datamonthbar3 = DB::table('issues')->whereBetween('Date_In', ['2020-10-01', '2020-10-31'])->count();
        $datamonthbar4 = DB::table('issues')->whereBetween('Date_In', ['2020-11-01', '2020-11-30'])->count();
        $datamonthbar5 = DB::table('issues')->whereBetween('Date_In', ['2020-12-01', '2020-12-31'])->count();
        $datatotalmonthbar = "" . $datamonthbar . "," . $datamonthbar1 . "," . $datamonthbar2 . "," . $datamonthbar3 . "
        ," . $datamonthbar4 . "," . $datamonthbar5 . "";

        // dd($issueschange);
        return view('user.dashboarduser', compact(
            ['data'],
            ['data2'],
            ['data3'],
            ['data4'],
            ['datalabel'],
            ['datatotal'],
            ['datatotalmonthbar'],
            ['datattbar'],
            ['datattbar2'],
            ['datattbar3'],
            ['datattbarsw'],
            ['datattbarsw2'],
            ['fromdate'],
            ['todate']
        ));
    }
}
