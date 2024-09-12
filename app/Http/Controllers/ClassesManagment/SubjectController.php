<?php

namespace App\Http\Controllers\ClassesManagment;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectsRequest\assignTeacherRequest;
use App\Http\Requests\SubjectsRequest\UpdateAssignTeacherRequest;
use App\Models\Classroom;
use App\Models\ClassroomSubject;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Session;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();
        return view('admin_panel.subjects.index')->with('subjects', $subjects);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('subjects')->where(function ($query) {
                    return $query->where('school_id', auth()->user()->school_id);
                })
            ]
        ]);
        Subject::create(['name' => $request->name]);
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->route('subject.index');
    }

    public function assign_teacher()
    {
        $subjects = Subject::get();
        $classrooms = Classroom::get();
        $teachers = User::where('school_id',auth()->user()->school_id)->whereRoleId(2)->get();
        return view('admin_panel.subjects.assign-teacher')->with([
            'subjects' => $subjects,
            'classrooms' => $classrooms,
            'teachers' => $teachers
        ]);

    }

    public function filter_section(int $id)
    {
        $data = Section::where('classroom_id', $id)->get()->map(function ($section) {
            return [
                'id' => $section->id,
                'text' => $section->name,
            ];
        });

        return response()->json($data);
    }

    public function assign(assignTeacherRequest $request)
    {
        $data = $request->validated();
        $activeYearId = Session::get('year_id');
        foreach ($data['section_ids'] as $section_id) {
            $exists = ClassroomSubject::whereYearId($activeYearId)
                ->whereSectionId($section_id)
                ->whereSubjectId($data['subject_id'])
                ->whereTeacherId($data['teacher_id'])->exists();
            if ($exists) {
                session()->flash('error', __('alert.alert_already_exists'));
                return redirect()->back();
            }
            ClassroomSubject::create([
                'teacher_id' => $data['teacher_id'],
                'subject_id' => $data['subject_id'],
                'classroom_id' => $data['classroom_id'],
                'section_id' => $section_id,
                'year_id' => $activeYearId,
            ]);
        }
        session()->flash('success', __('alert.alert_saved'));
        return redirect()->route('subject.assign_teacher');

    }

    public function teachers()
    {
        $teachers = ClassroomSubject::where('year_id', Session::get('year_id'))->get();
        $years = Year::get();
        return view('admin_panel.subjects.teachers')
            ->with(['teachers' => $teachers, 'years' => $years, 'year_id' => null]);
    }

    public function filter_years(int $id)
    {
        $teachers = ClassroomSubject::where('year_id', $id)->get();
        $years = Year::get();
        return view('admin_panel.subjects.teachers')
            ->with(['teachers' => $teachers, 'years' => $years, 'year_id' => $id]);

    }

    public function delete_teacher(Request $request)
    {
        ClassroomSubject::find($request->id)->delete();
        session()->flash('success', __('alert.alert_delete'));
        return redirect()->route('subject.teacher');
    }

    public function edit_assign_teacher(int $id)
    {
        $subjects = Subject::get();
        $classrooms = Classroom::get();
        $teachers = User::where('school_id',auth()->user()->school_id)->whereRoleId(2)->get();
        $classroomSubject = ClassroomSubject::findOrFail($id);
        $sections = Section::whereClassroomId($classroomSubject->classroom_id)->get();
        return view('admin_panel.subjects.update-assign-teacher')->with([
            'subjects' => $subjects,
            'classrooms' => $classrooms,
            'teachers' => $teachers,
            'classroomSubject' => $classroomSubject,
            'sections' => $sections,
        ]);
    }

    public function update_assign_teacher(UpdateAssignTeacherRequest $request)
    {
        $data = $request->validated();
        $activeYearId = Session::get('year_id');
        $exists = ClassroomSubject::whereYearId($activeYearId)
            ->whereSectionId($data['section_id'])
            ->whereSubjectId($data['subject_id'])
            ->whereTeacherId($data['teacher_id'])->exists();
        if ($exists) {
            session()->flash('error', __('alert.alert_already_exists'));
            return redirect()->back();
        }
        ClassroomSubject::find($data['id'])->update([
            'teacher_id' => $data['teacher_id'],
            'subject_id' => $data['subject_id'],
            'classroom_id' => $data['classroom_id'],
            'section_id' => $data['section_id'],
        ]);
        session()->flash('success', __('alert.alert_update'));
        return redirect()->route('subject.teacher');

    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:subjects,id'],
            'name' => [
                'required',
                'string',
                Rule::unique('subjects')->where(function ($query) {
                    return $query->where('school_id', auth()->user()->school_id);
                })
            ]
        ]);
        Subject::find($request->id)->update($request->all());
        session()->flash('success', __('alert.alert_update'));
        return redirect()->route('subject.index');
    }


}
