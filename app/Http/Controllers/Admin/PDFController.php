<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Issues;
use App\Models\IssuesLogs;
use App\Models\Issuespriority;
use App\Models\Issuesstatus;
use App\Models\Issuestracker;
use App\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function pdf($Issuesid){
        $Issues = Issues::find($Issuesid);
        $trackname = Issuestracker::all();
        $issuespriority = Issuespriority::all();
        $issuesstatus = Issuesstatus::all();
        $department = Department::all();
        $user = User::all();
        $issueslog = DB::table('issues_logs')
            ->select('issues_logs.create_at')
            ->join('issues', 'issues.Issuesid', '=', 'issues_logs.Issuesid')
            ->where([['Action', 'Closed'], ['issues_logs.Issuesid', $Issues->Issuesid]])
            ->get();
        $pdf = PDF::loadView('pdf',['Issues'=>$Issues,'trackname'=>$trackname
        ,'issuespriority'=>$issuespriority,'issuesstatus'=>$issuesstatus,'department'=>$department,'user'=>$user,'issueslog'=>$issueslog]);
        return $pdf->stream('Dataview.pdf');
    }
}
