<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IssuesComment;
use Illuminate\Http\Request;

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

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate(
            $request,
            array(
                'CComment' => 'required',
            ),
        );

        $comment = new IssuesComment();
        $comment->Issuesid = 0;
        $comment->Type = 0;
        $comment->Status = 1;
        $comment->Comment = $request->input('CComment');
        $comment->Uuid = $request->input('Ctemp');
        $comment->Createby = $request->input('CCreateby');
        $comment->Updateby = $request->input('CCreateby');
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

    }

    public function storeedit(Request $request)
    {
        $this->validate(
            $request,
            array(
                'CComment' => 'required',
            ),
        );

        $comment = new IssuesComment();
        $comment->Issuesid = $request->input('Issuesid');
        $comment->Type = 0;
        $comment->Status = 1;
        $comment->Comment = $request->input('CComment');
        $comment->Uuid = $request->input('Ctemp');
        $comment->Createby = $request->input('CCreateby');
        $comment->Updateby = $request->input('CCreateby');
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

    }

}
