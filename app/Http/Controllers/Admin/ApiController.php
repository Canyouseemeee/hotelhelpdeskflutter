<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Issues;
use App\Models\IssuesCheckin;
use App\Models\IssuesComment;
use App\Models\Loginlog;
use App\Models\MacAddress;
use App\Models\VersionApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;
use SebastianBergmann\Environment\Console as EnvironmentConsole;

function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("m", strtotime($strDate));
    $strDay = date("d", strtotime($strDate));
    $strHour = date("H", strtotime($strDate)) + 7;
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    return "$strYear-$strMonth-$strDay $strHour:$strMinute:$strSeconds";
}

function DateThai2($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("m", strtotime($strDate));
    $strDay = date("d", strtotime($strDate));
    $strHour = date("H", strtotime($strDate)) + 7;
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    if ($strHour < 10 && $strHour >= 0) {
        return "$strYear$strMonth$strDay 0$strHour$strMinute$strSeconds";
    } else {
        return "$strYear$strMonth$strDay$strHour$strMinute$strSeconds";
    }
}


class ApiController extends Controller
{

    public function Closed()
    {
        $demodata = DB::table('issues_tracker')
            ->select(
                'issues.Issuesid',
                'issues_tracker.TrackName',
                'issues_tracker.SubTrackName',
                'issues_tracker.Name',
                'issues_status.ISSName',
                'issues_priority.ISPName',
                'issues.Createby',
                'users.name as Assignment',
                'issues.UpdatedBy',
                'issues.Subject',
                'issues.Tel',
                'issues.Comname',
                'issues.Informer',
                'issues.Description',
                'issues.created_at',
                'issues.updated_at',
                'department.DmName',
                'issues.ClosedBy',
                'issues_logs.create_at'
            )
            ->join('issues', 'issues.Trackerid', '=', 'issues_tracker.Trackerid')
            ->join('issues_priority', 'issues.Priorityid', '=', 'issues_priority.Priorityid')
            ->join('issues_status', 'issues.Statusid', '=', 'issues_status.Statusid')
            ->join('department', 'issues.Departmentid', '=', 'department.Departmentid')
            ->join('issues_logs', 'issues.Issuesid', '=', 'issues_logs.Issuesid')
            ->join('users', 'issues.Assignment', '=', 'users.id')
            ->where([['issues.Statusid', 2], ['issues_logs.Action', 'Closed']])
            ->orderBy('issues.Issuesid', 'DESC')
            ->limit(15)
            ->get();
        $issues = Issues::all();

        return response()->json($demodata);
    }

    public function New()
    {
        $demodata = DB::table('issues_tracker')
            ->select(
                'Issuesid',
                'issues_tracker.TrackName',
                'issues_tracker.SubTrackName',
                'issues_tracker.Name',
                'ISSName',
                'ISPName',
                'issues.Createby',
                'users.name as Assignment',
                'issues.UpdatedBy',
                'issues.Subject',
                'issues.Tel',
                'issues.Comname',
                'issues.Informer',
                'issues.Description',
                'issues.created_at',
                'issues.updated_at',
                'DmName'
            )
            ->join('issues', 'issues.Trackerid', '=', 'issues_tracker.Trackerid')
            ->join('issues_priority', 'issues.Priorityid', '=', 'issues_priority.Priorityid')
            ->join('issues_status', 'issues.Statusid', '=', 'issues_status.Statusid')
            ->join('department', 'issues.Departmentid', '=', 'department.Departmentid')
            ->join('users', 'issues.Assignment', '=', 'users.id')
            ->where('issues.Statusid', 1)
            ->orderBy('issues.Issuesid', 'DESC')
            ->get();
        $issues = Issues::all();

        return response()->json($demodata);
    }

    public function Defer()
    {
        $demodata = DB::table('issues_tracker')
            ->select(
                'issues.Issuesid',
                'issues_tracker.TrackName',
                'issues_tracker.SubTrackName',
                'issues_tracker.Name',
                'ISSName',
                'ISPName',
                'issues.Createby',
                'users.name as Assignment',
                'issues.UpdatedBy',
                'issues.Subject',
                'issues.Tel',
                'issues.Comname',
                'issues.Informer',
                'issues.Description',
                'issues.created_at',
                'issues.updated_at',
                'DmName'
            )
            ->join('issues', 'issues.Trackerid', '=', 'issues_tracker.Trackerid')
            ->join('issues_priority', 'issues.Priorityid', '=', 'issues_priority.Priorityid')
            ->join('issues_status', 'issues.Statusid', '=', 'issues_status.Statusid')
            ->join('department', 'issues.Departmentid', '=', 'department.Departmentid')
            ->join('issues_logs', 'issues.Issuesid', '=', 'issues_logs.Issuesid')
            ->join('users', 'issues.Assignment', '=', 'users.id')
            ->where([['issues.Statusid', 3], ['issues_logs.Action', 'Updated']])
            ->groupBy('issues.Issuesid')
            ->orderBy('issues.Issuesid', 'DESC')
            ->get();
        $issues = Issues::all();

        return response()->json($demodata);
    }

    public function poststatus(Request $request)
    {
        $_issuesid = $request->input('issuesid');
        $_user = $request->input('user');

        $checkin = new IssuesCheckin();
        $checkin->Issuesid = $_issuesid;
        $checkin->Status = 1;
        $checkin->Detail = '';
        $checkin->Createby = $_user;
        $checkin->created_at = DateThai(now());
        $checkin->updated_at = DateThai(now());
        $checkin->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updateclosedstatus(Request $request)
    {
        $_issuesid = $request->input('issuesid');
        $_user = $request->input('user');
        $_detail = $request->input('detail');
        $_checkid = $request->input('checkin');

        $checkinid = DB::table('issues_checkin')
            ->select('*')
            ->where('Issuesid', $_issuesid)
            ->get();

        $checkin = IssuesCheckin::find($_checkid);
        $checkin->Status = 2;
        $checkin->Detail = $_detail;
        $checkin->Updateby = $_user;
        $checkin->updated_at = DateThai(now());
        $checkin->update();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function updatekeepstatus(Request $request)
    {
        $_issuesid = $request->input('issuesid');
        $_user = $request->input('user');
        $_detail = $request->input('detail');
        $_checkid = $request->input('checkin');

        $checkinid = DB::table('issues_checkin')
            ->select('*')
            ->where('Issuesid', $_issuesid)
            ->get();

        $checkin = IssuesCheckin::find($_checkid);
        $checkin->Status = 3;
        $checkin->Detail = $_detail;
        $checkin->Updateby = $_user;
        $checkin->updated_at = DateThai(now());
        $checkin->update();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function getstatus(Request $request)
    {
        $_issuesid = $request->input('issuesid');

        $checkin = DB::table('issues_checkin')
            ->select('*')
            ->where('Issuesid', $_issuesid)
            ->get();
        // $checkin = IssuesCheckin::all();
        return response()->json($checkin);
    }

    public function getcountComment(Request $request)
    {
        $_issuesid = $request->input('issuesid');
        $comment = DB::table('issues_comment')
            ->select('*')
            ->where('Issuesid', $_issuesid)
            ->count();
        return response()->json(['count' => $comment]);
    }

    public function getComment(Request $request)
    {
        $_issuesid = $request->input('issuesid');
        $comment = DB::table('issues_comment')
            ->select('*')
            ->where('Issuesid', $_issuesid)
            ->get();
        return response()->json($comment);
    }

    public function postComment(Request $request)
    {
        $_issuesid = $request->input('issuesid');
        $_comment = $request->input('comment');
        $_user = $request->input('user');


        $comment = new IssuesComment();
        $comment->Issuesid = $_issuesid;
        $comment->Type = 1;
        $comment->Comment = $_comment;
        $comment->Createby = $_user;
        $comment->created_at = DateThai(now());
        $comment->updated_at = DateThai(now());

        if ($request->hasFile('image')) {
            $filename = $request->image->getClientOriginalName();
            $file = time() . '.' . $filename;
            $comment->Image = $request->image->storeAs('images', $file, 'public');
            // dd($file);
        } else {
            $comment->Image = null;
        }

        $comment->save();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function postStatusComment(Request $request)
    {
        $_commentid = $request->input('commentid');

        $comment = IssuesComment::find($_commentid);
        $comment->Status = 0;
        $comment->update();

        return response()->json([
            'status' => 'success'
        ]);
    }

    public function postlogin(Request $request)
    {
        $_username = $request->input('username');
        $_deviceid = $request->input('deviceid');
        $_ip = $request->input('ip');
        $_token = $request->input('token');
        $_expired = DateThai2(now()->addHours(8));

        $data = DB::table('users')
            ->select('id')
            ->where('username', $_username)
            ->get();

        $image = DB::table('users')
            ->select('image')
            ->where('username', $_username)
            ->get();

        $Loginlog = new Loginlog();
        $Loginlog->Deviceid = $_deviceid;
        $Loginlog->Userid = $data[0]->id;
        $Loginlog->Token = $_token;
        $Loginlog->Ip = $_ip;
        $Loginlog->expired = DateThai(now()->addHours(8));
        $Loginlog->created_at = DateThai(now());
        $Loginlog->updated_at = DateThai(now());
        $Loginlog->save();

        return response()->json([
            'status' => 'Success',
            'data' => $data,
            'deviceid' => $_deviceid,
            'ip' => $_ip,
            'token' => $_token,
            'expired' => $_expired,
            'image' => $image
        ]);
    }

    public function delete(Request $request)
    {
        $_token = $request->input('token');

        $data = DB::table('loginlog')
            ->select('Loginid')
            ->where([['Token', $_token], ['expired', '<', DateThai(now())]])
            ->get();
        // $Loginlog = Loginlog::findOrFail($data[0]->Loginid);
        // $Loginlog->delete();
        return response()->json([
            'action' => 'Delete',
            'status' => 'Success'
        ]);
    }

    public function Deviceid(Request $request)
    {
        $_deviceid = $request->input('deviceid');

        $data = DB::table('deviceinfo')
            ->select('deviceid')
            ->where('deviceid', $_deviceid)
            ->get();

        return response()->json([
            'status' => 'Success',
            'deviceid' => $data
        ]);
    }

    public function lastedVersion()
    {
        $VersionApp = DB::table('version_app')
            ->select('AppVersion',)
            ->max('AppVersion');
        $url = DB::table('version_app')
            ->select('url',)
            ->max('url');

        return response()->json([
            'version' => $VersionApp,
            'url' => $url
        ]);
    }

    public function Appointments()
    {
        $Appointments = DB::table('appointments')
            ->select('*',)
            ->where([['Status', '1'], ['Issuesid', '>', 0]])
            ->whereBetween('Date', [DateThai(now()), DateThai(now()->addDay(7))])
            ->get();

        return response()->json($Appointments);
    }

    public function Appointmentlist(Request $request)
    {
        $temp = $request->input('temp');

        $data = DB::table('appointments')
            ->select('*')
            ->where('Uuid', $temp)
            ->orderBy('Appointmentsid', 'DESC')
            ->get();

        return response()->json($data);
    }

    public function Commentlist(Request $request)
    {
        $temp = $request->input('temp');

        $data = DB::table('issues_comment')
            ->select('users.image','issues_comment.Commentid','issues_comment.Issuesid','issues_comment.Status','issues_comment.Type','issues_comment.Comment','issues_comment.Image'
            ,'issues_comment.Uuid','issues_comment.Createby','issues_comment.Updateby','issues_comment.created_at','issues_comment.updated_at')
            ->join('users', 'issues_comment.Createby', '=', 'users.name')
            ->where('Uuid', $temp)
            ->orderBy('Commentid', 'DESC')
            ->get();
        foreach ($data as $row) {
            $createbycomment = $row->Createby;
        }

        return response()->json($data);
    }

    public function CommentlistStatus(Request $request)
    {
        $Commentid = $request->input('commentid');
        // echo($Commentid);
        $data = DB::table('issues_comment')
            ->select('*')
            ->where('Commentid', $Commentid)
            ->get();
        foreach ($data as $row) {
            $cid = $row->Commentid;
            // echo($row->Commentid);
        }
        $comments = IssuesComment::find($cid);
        $comments->Status = 0;
        $comments->update();

        return response()->json($comments);
    }
}
