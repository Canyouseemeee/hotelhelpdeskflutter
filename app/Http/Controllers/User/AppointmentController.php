<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate)) + 7;
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    return "$strDay-$strMonth-$strYear $strHour:$strMinute:$strSeconds";
}


class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            array(
                'AppointDate' => 'required',
                'Comment' => 'required',
            ),
        );
        $count = DB::table('appointments')
            ->select('Appointmentsid')
            ->where('Uuid', $request->input('temp'))
            ->count();
        // echo($count);
        if ($count >= 1) {
            $data = DB::table('appointments')
                ->select('Appointmentsid')
                ->where('Uuid', $request->input('temp'))
                ->max('Appointmentsid');
            $appoint = Appointments::find($data);
            $appoint->Status = 2;
            $appoint->update();
        }
        $appointment = new Appointments();
        $appointment->Issuesid = 0;
        $appointment->Date = $request->input('AppointDate');
        $appointment->Comment = $request->input('Comment');
        $appointment->Status = $request->input('Status');
        $appointment->Createby = $request->input('Createby');
        $appointment->Updateby = $request->input('Createby');
        // $Uuidapp = Str::uuid()->toString();
        $appointment->Uuid = $request->input('temp');
        $appointment->created_at = DateThai(now());
        $appointment->updated_at = DateThai(now());
        $appointment->save();

        return back();
    }

    public function update(Request $request)
    {
        $this->validate(
            $request,
            array(
                'AppointDate' => 'required',
                'Comment' => 'required',
            ),
        );
        $Uuid = $request->input('temp');
        $Appoint =  DB::table('appointments')
            ->select('Appointmentsid')
            ->where('Uuid', $Uuid)
            ->get();
        foreach ($Appoint as $row) {
            $Appointmentsid = $row->Appointmentsid;
        }
        $appointment = Appointments::find($Appointmentsid);
        $appointment->Issuesid = 0;
        $appointment->Date = $request->input('AppointDate');
        $appointment->Comment = $request->input('Comment');
        $appointment->Status = $request->input('Status');
        $appointment->Updateby = $request->input('Updateby');
        $appointment->Uuid = $request->input('temp');
        $appointment->created_at = DateThai(now());
        $appointment->updated_at = DateThai(now());
        $appointment->update();

        return back();
    }

    public function storeedit(Request $request)
    {
        $this->validate(
            $request,
            array(
                'AppointDate' => 'required',
                'Comment' => 'required',
            ),
        );
        $count = DB::table('appointments')
            ->select('Appointmentsid')
            ->where('Uuid', $request->input('temp'))
            ->count();
        // echo($count);
        if ($count >= 1) {
            $data = DB::table('appointments')
                ->select('Appointmentsid')
                ->where('Uuid', $request->input('temp'))
                ->max('Appointmentsid');
            $appoint = Appointments::find($data);
            $appoint->Status = 2;
            $appoint->update();
        }
        $appointment = new Appointments();
        $appointment->Issuesid = $request->input('Issuesid');
        $appointment->Date = $request->input('AppointDate');
        $appointment->Comment = $request->input('Comment');
        $appointment->Status = $request->input('Status');
        $appointment->Createby = $request->input('Createby');
        $appointment->Updateby = $request->input('Createby');
        $appointment->Uuid = $request->input('temp');
        $appointment->created_at = DateThai(now());
        $appointment->updated_at = DateThai(now());
        $appointment->save();

        
        return back();
    }

    public function updateedit(Request $request)
    {
        $this->validate(
            $request,
            array(
                'AppointDate' => 'required',
                'Comment' => 'required',
            ),
        );
        $Uuid = $request->input('Uuid');
        $Appoint =  DB::table('appointments')
            ->select('Appointmentsid')
            ->where('Uuid', $Uuid)
            ->get();
        foreach ($Appoint as $row) {
            $Appointmentsid = $row->Appointmentsid;
        }
        $appointment = Appointments::find($Appointmentsid);
        $appointment->Issuesid = $request->input('Issuesid');
        $appointment->Date = $request->input('AppointDate');
        $appointment->Comment = $request->input('Comment');
        $appointment->Status = $request->input('Status');
        $appointment->Updateby = $request->input('Updateby');
        // $Uuidapp = Str::uuid()->toString();
        $appointment->Uuid = $request->input('Uuid');
        $appointment->created_at = DateThai(now());
        $appointment->updated_at = DateThai(now());
        $appointment->update();

        return back();
    }

    public function calendar2(){
        $appointments = DB::table('appointments')
        ->select('*')
        ->where('Issuesid','>', 0)
        ->get();
        return view('user.calendar.index', compact('appointments'));
    }
}
