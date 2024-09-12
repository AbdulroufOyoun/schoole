<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest\StoreBatchRequest;
use App\Http\Requests\PaymentRequest\StoreStudentFeeRequest;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Models\Year;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getStudentsFees()
    {
        $fees = Fee::whereYearId(session('year_id'))->get();
        $students = Student::whereYearId(session('year_id'))->get();
        return view('admin_panel.payments.students-fees', compact('fees', 'students'));

    }

    public function storeStudentsFees(StoreStudentFeeRequest $request)
    {
        $data = $request->validated();
        foreach ($data['student_ids'] as $student_id) {
            $exists = Fee::where('year_id', $data['year_id'])
                ->where('student_id', $student_id)->exists();
            if ($exists)
                return redirect()->back()->withErrors(['exists', __('alert.alert_already_exists')]);
            $parent_id = User::find($student_id)->parent;
            Fee::create([
                'student_id' => $student_id,
                'parent_id' => $parent_id,
                'year_id' => $data['year_id'],
                'fee' => $data['fee'],
            ]);
        }
        \Session::flash('success', __('alert.alert_saved'));
        return redirect()->back();
    }

    public function deleteStudentFee(Request $request)
    {
        $request->validate(['id'=>['required','integer','exists:fees,id']]);
        Fee::find($request->id)->delete();
        \Session::flash('success', __('alert.alert_delete'));
        return redirect()->back();
    }

    public function getParentsPayments()
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $parents = Fee::whereYearId($year_id)->get()->groupBy('parent_id')->map(function ($parent)use ($year_id){
            $total_fees=0;
            $number_of_sons = 0;
            foreach ($parent as $son){
                $total_fees += $son->fee;
                $number_of_sons += 1;
            }
            $exist =Payment::whereYearId($year_id)->whereParentId($parent[0]->parent->id)->latest()->first();
            return [
                'parent_id'=>$parent[0]->parent->id,
                'parent_name'=>$parent[0]->parent->name.' '.$parent[0]->parent->last_name,
                'number_of_sons'=>$number_of_sons,
                'total_fees'=>$total_fees,
                'total_payments'=>Payment::whereYearId($year_id)->whereParentId($parent[0]->parent->id)->sum('batch'),
                'next_batch'=>$exist?$exist->next_batch:null,
            ];
        });
        return view('admin_panel.payments.parents-payments',compact('parents'));
    }

    public function getParentPaymentsDetails($id)
    {
        $year_id = Year::whereActivated(true)->first()->id;
        $batches = Payment::whereYearId($year_id)->whereParentId($id)->latest()->get();
        $parent_id = $id;
        return view('admin_panel.payments.parent-payments-details',compact('batches','parent_id'));
    }

    public function storeBatch(StoreBatchRequest $request)
    {
       $data =  $request->validated();
       Payment::create($data);
       session()->flash('success',__('alert.alert_saved'));
       return redirect()->back();
    }

    public function deleteBatch(Request $request)
    {
        $request->validate(['id'=>['required','integer','exists:payments,id']]);
        Payment::find($request->id)->delete();
        session()->flash('success',__('alert.alert_delete'));
        return redirect()->back();

    }
}
