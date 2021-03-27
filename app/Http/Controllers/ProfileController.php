<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Student;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $courses = Course::all();
        return view(
            'index',
            [
                'records' => $courses,
            ]
        );
    }

    /**
     * @param Request $request
     */
    public function cache(Request $request)
    {
        if ($cacheTime = Cache::get('profileCacheTime')) {
            return response()->json([
                'time' => $cacheTime,
             ]);
        }

        $now = Carbon::now();
        Cache::set('profileCacheTime', $now, 60);

        return response()->json([
            'time' => $now,
        ]);
    }

    /**
     * @param Request $request
     */
    public function course($course_id)
    {
        $course = Course::find($course_id);
        return view(
            'course',
            [
                'data' => $course,
                'students' => $course->students()->get(),
            ],
        );
    }

    /**
     * @param Request $request
     */
    public function student($student_id)
    {
        $student = Student::find($student_id);
        return view(
            'student',
            [
                'data' => $student,
                'profile' => $student->profile,
                'github' => $student->profile->getGithubUrlAttribute(),
                'courses' => $student->courses()->get(),
            ],
        );
    }
}
