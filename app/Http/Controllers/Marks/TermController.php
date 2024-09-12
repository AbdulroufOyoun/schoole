<?php

namespace App\Http\Controllers\Marks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermsRequest\StoreSemesterRequest;
use App\Http\Requests\TermsRequest\StoreTermRequest;
use App\Http\Requests\TermsRequest\UpdateSemesterRequest;
use App\Http\Requests\TermsRequest\UpdateTermRequest;
use App\Models\Semester;
use App\Models\Term;
use App\Models\User;
use App\Notifications\FirebaseNotification;

class TermController extends Controller
{

    public function getSemesters()
    {
        $semesters = Semester::where('year_id', session('year_id'))->latest()->get();
        return view('admin_panel.marks.semesters', compact('semesters'));
    }

    public function storeSemester(StoreSemesterRequest $request)
    {
        $data = $request->validated();
        Semester::create($data);
        $request->session()->flash('success',__('alert.alert_saved'));
        return redirect()->back();
    }

    public function updateSemester(UpdateSemesterRequest $request)
    {
        $data = $request->validated();
        Semester::find($data['id'])->update($data);
        $request->session()->flash('success',__('alert.alert_update'));
        return redirect()->back();

    }

    public function getTerms()
    {
        $terms = Term::where('year_id', session('year_id'))->latest()->get();
        return view('admin_panel.marks.terms', compact('terms'));
    }

    public function storeTerm(StoreTermRequest $request)
    {
        $data = $request->validated();
        Term::create($data);
        $request->session()->flash('success',__('alert.alert_saved'));
        return redirect()->back();

    }

    public function updateTerm(UpdateTermRequest $request)
    {
        $data = $request->validated();
        Term::find($data['id'])->update($data);
        $request->session()->flash('success',__('alert.alert_update'));
        return redirect()->back();

    }

    public function termActivation($id)
    {
        $term = Term::find($id);
        $term->update(['activated' => true]);

        #send notifications to all users
        $users = User::where('school_id',auth()->user()->school_id)->where('role_id', 1)->orWhere('role_id', 4)->get();
        $fcm_tokens = [];
        $users_ids = [];
        foreach ($users as $user) {
            $fcm_tokens[] = $user->fcm_token;
            $users_ids[] = $user->id;
        }

        $message = [
            'title' => $term->name .' marks have been completed',
            'body' => 'You can browse marks ,classwork ,homework and evaluation',
            'type' => 'marks',
            'url' => url('api/marks/get-student-marks'),

        ];
        \Notification::send(null, new FirebaseNotification($fcm_tokens, $message, $users_ids));

        session()->flash('success', __('alert.alert_activeted'));
        return redirect()->back();
    }


}
