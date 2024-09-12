<?php

namespace App\Http\Controllers;
use App\Models\Activities;
use App\Models\AdvertisingTeacher;
use App\Models\Calendar;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Student;
use App\Models\User;
use App\Models\Year;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use ImageTrait;

    public function advertising()
    {
        $settings = Setting::first();
        $activities = Activities::get();
        $teachers = AdvertisingTeacher::get();
        return view('website.advertising.advertising-page',compact('settings','activities','teachers'));
    }

    public function dashboard()
    {

        $total_event = Calendar::count();
//        payment
        $total_fees = Fee::where('year_id',session('year_id'))->sum('fee');
        $total_payment = Payment::where('year_id',session('year_id'))->sum('batch');
//        social media
        $total_posts = Post::count();
        $rejected_posts = Post::whereNotNull('reason_reject')->count();
//        chart od posts
        $year = date('Y');
        $posts = array_fill(0, 12, 0);
        $postsQuery = DB::table('posts')
            ->select(DB::raw('count(*) as total, month(created_at) as month'))
            ->whereYear('created_at', '=', $year)
            ->groupBy(DB::raw('month(created_at)'))
            ->get();
        foreach ($postsQuery as $post) {
            $posts[$post->month - 1] = $post->total;
        }

//        account type
        $users = User::whereSchoolId(auth()->user()->school_id)->get();
        $total_user = count($users);
        $accountTypes = [
            __('index.student') => 0,
            __('index.teacher') => 0,
            __('index.editor') => 0,
            __('index.Parent') => 0,
            __('index.academic') => 0,
            __('index.accountant') => 0,
            __('index.admin') => 0,
        ];
        foreach ($users as $user) {
            if ( $user->accountType === "super admin")
                continue;
            $accountType = $user->accountType;
            $accountTypes[$accountType]++;
        }

//        percentage of promoted student
        $year = Year::latest()->skip(1)->first();
        if (!$year){
            $percentage = 0;
        }else{
            $studentsPromoted = Student::whereYearId($year->id)->whereStatus('promoted')->count();
            $studentsfailed = Student::whereYearId($year->id)->whereStatus('fail')->count();
            $allStudents = $studentsfailed + $studentsPromoted;
            $percentage = $allStudents != 0 ? (($studentsPromoted * 100) / $allStudents) : 0;
        }
        return view('admin_panel.index')->with([
            'total_event' => $total_event,
            'total_fees' => $total_fees,
            'total_payment' => $total_payment,
            'total_posts' => $total_posts,
            'rejected_posts' => $rejected_posts,
            'posts' => $posts,
            'accountTypes' => $accountTypes,
            'total_user'=>$total_user,
            'percentage' => $percentage,
        ]);
    }

    public function privacy()
    {
        $settings = Setting::first();
        return view('website.privacy',compact('settings'));
    }

}
