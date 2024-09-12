<?php

namespace App\Http\Controllers\ClassesManagment;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomsRequest\PromotionStudentsRequest;
use App\Http\Requests\ClassroomsRequest\StoreClassroomRequest;
use App\Http\Requests\ClassroomsRequest\UpdateClassroomRequest;
use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    public function index()
    {
        $classrooms = Classroom::get();
        return view('admin_panel.classrooms.index')->with('classrooms', $classrooms);
    }

    public function delete(Request $request)
    {
        Classroom::find($request->id)->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->route('classrooms.index');
    }

    public function store(StoreClassroomRequest $request)
    {
        $data = $request->validated();
        $item = Classroom::create(['name' => $request->name]);

        for ($i = 1; $i <= $request->section_number; $i++) {
            Section::create([
                'name' => "Section " . $i,
                'classroom_id' => $item->id,
            ]);
        }
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->route('classrooms.index');

    }
    public function update(UpdateClassroomRequest $request)
    {
        $data = $request->validated();
        Classroom::find($request->id)->update($data);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->route('classrooms.index');

    }

    public function add_section(Request $request)
    {
        $request->validate(['name' => ['required','string']]);
        Section::create($request->all());
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->route('classrooms.index');
    }

    public function index_section(int $id)
    {
        $sections = Section::where('classroom_id', $id)->get();
        $classroom = Classroom::find($id);
        return view('admin_panel.classrooms.sections')->with(['sections' => $sections, 'classroom' => $classroom]);
    }

    public function delete_section(Request $request)
    {
        $year_id  = Year::whereActivated(true)->first()->id;
        $exists = ClassroomSubject::whereYearId($year_id)->whereSectionId($request->id)->exists();
        if ($exists){
            return redirect()->back()->withErrors(['error'=>__('alert.delete_section')]);
        }
        Section::find($request->id)->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }

    public function update_section(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:sections,id'],
            'name' => ['required', 'string']
        ]);
        Section::find($request->id)->update(['name' => $request->name]);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->back();
    }

    public function select_option()
    {
        $last_yaar = Year::latest()->first();
        $message = null;
        if ($last_yaar->activated == true) {
            $message = __('alert.no_new_year');
        }
        $classrooms = Classroom::get();
        return view(
            'admin_panel.classrooms.Students-promotion.select-calssroom'
            ,
            compact(['classrooms', 'last_yaar', 'message'])
        );
    }

    public function select_students(PromotionStudentsRequest $request)
    {
        $data = $request->validated();
        session()->put('to_classroom_id', $data['to_classroom_id']);
        session()->put('to_section_id', $data['to_section_id']);
        $students = User::where('school_id',auth()->user()->school_id)->whereHas('section', function ($query) use ($data) {
            $query->where(['processed' => false, 'year_id' => session()->get('year_id')])
                ->whereIn('section_id', $data['from_section_ids']);
        })->with('section')->get();
        if ($data['action'] == 'promotion')
            return view('admin_panel.classrooms.Students-promotion.select-students', compact('students'));
        return view('admin_panel.classrooms.Students-promotion.select-fail-student', compact('students'));

    }


    public function promotion(Request $request)
    {
        $request->validate([
            'ids' => ['array', 'required'],
            'ids.*' => ['integer', 'exists:users,id']
        ]);
        $last_year = Year::latest()->first();
        $student = Student::whereUserId($request->ids[0])->first();
        $student_year = Year::find($student->year_id)->end_date;
        if ($student_year >= $last_year->end_date) {
            $request->session()->flash('error', __('alert.error_promotion'));
            return redirect()->back();
        }
        foreach ($request->ids as $id) {
            Student::whereUserId($id)->update(['processed' => true, 'status' => 'promoted']);
            Student::create([
                'user_id' => $id,
                'classroom_id' => session()->get('to_classroom_id'),
                'section_id' => session()->get('to_section_id'),
                'year_id' => $last_year->id,
            ]);
        }
        $request->session()->flash('success', __('alert.success_promotion'));
        return redirect()->route('classrooms.select-option');
    }

    public function deposition(Request $request)
    {
        $request->validate([
            'ids' => ['array', 'required'],
            'ids.*' => ['integer', 'exists:users,id']
        ]);
        $last_year = Year::latest()->first();
        $student = Student::whereUserId($request->ids[0])->first();
        $student_year = Year::find($student->year_id)->end_date;
        if ($student_year >= $last_year->end_date) {
            $request->session()->flash('error', __('alert.error_promotion'));
            return redirect()->back();
        }
        foreach ($request->ids as $id) {
            Student::whereUserId($id)->update(['processed' => true, 'status' => 'fail']);
            Student::create([
                'user_id' => $id,
                'classroom_id' => session()->get('to_classroom_id'),
                'section_id' => session()->get('to_section_id'),
                'year_id' => $last_year->id,
            ]);
        }
        $request->session()->flash('success', __('alert.success_deposition'));
        return redirect()->route('classrooms.select-option');
    }


}
