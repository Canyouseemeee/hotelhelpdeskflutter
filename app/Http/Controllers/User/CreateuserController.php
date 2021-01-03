<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HtIssues;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

function DateThai2($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate)) + 7;
    $strMinute = date("i", strtotime($strDate)) - 1;
    $strSeconds = date("s", strtotime($strDate));
    if ($strMonth < 10 && $strMinute < 10) {
        return "$strYear-0$strMonth-$strDay $strHour:0$strMinute:$strSeconds";
    } else {
        return "$strYear-$strMonth-$strDay $strHour:$strMinute:$strSeconds";
    }
}

class CreateuserController extends Controller
{
    public function index($roomid)
    {
        $data = Room::find($roomid);
        $typeissues = DB::table('typeissues')
            ->select('*')
            ->where('Status', 1)
            ->get();
        $temp = Str::uuid()->toString();
        return view('user.createqr.create', compact('data', 'typeissues','temp'));
    }

    public function store(Request $request)
    {
        $htissues = new HtIssues();
        $htissues->Roomid = $request->input('Roomid');
        $htissues->Statusid = $request->input('Statusid');
        $htissues->Typeissuesid = $request->input('Typeissuesid');
        $htissues->Createby = $request->input('Createby');
        $htissues->Updatedby = $htissues->Createby;
        $htissues->Assignment = 1;
        $htissues->Subject = $request->input('Subject');
        $htissues->Description = $request->input('Description');
        $htissues->Date_In = $request->input('Date_In');
        $htissues->Uuid = $request->input('temp');
        $htissues->created_at = DateThai(now());
        $htissues->updated_at = DateThai(now());

        if ($request->hasFile('Image')) {
            $filename = $request->Image->getClientOriginalName();
            $file = time() . '.' . $filename;
            $htissues->Image = $request->Image->storeAs('images', $file, 'public');
            // dd($file);
        } else {
            $htissues->Image = null;
        }

        $htissues->save();

        return redirect('/success')->with('status', 'Success');
    }

    public function success()
    {
        return view('user.createqr.success');
    }
}
