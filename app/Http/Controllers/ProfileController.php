<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Course;

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
            'profile',
            [
                'name' => 'Natz Liu',
                'id' => 1234,
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
    public function course($id)
    {
        $course = Course::find($id);
        return view(
            'course',
            [
                'data' => $course,
            ],
        );
    }

    /**
     * @param Request $request
     */
    public function php_basic(Request $request)
    {
        return view(
            'php_basic',
        );
    }

    /**
     * @param Request $request
     */
    public function git_basic(Request $request)
    {
        return view(
            'git_basic',
        );
    }

    /**
     * @param Request $request
     */
    public function docker(Request $request)
    {
        return view(
            'docker',
        );
    }

    /**
     * @param Request $request
     */
    public function cicd(Request $request)
    {
        return view(
            'cicd',
        );
    }

    /**
     * @param Request $request
     */
    public function criptografia(Request $request)
    {
        return view(
            'criptografia',
        );
    }

    /**
     * @param Request $request
     */
    public function database(Request $request)
    {
        return view(
            'database',
        );
    }

    /**
     * @param Request $request
     */
    public function laravel(Request $request)
    {
        return view(
            'laravel',
        );
    }

    /**
     * @param Request $request
     */
    public function designpattern(Request $request)
    {
        return view(
            'designpattern',
        );
    }
}
