<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view(
            'profile',
            [
                'name' => 'Natz Liu',
                'id' => 1234,
                'records' => [
                    [
                        'id' => 1,
                        'text' => 'AWS',
                        'url' => 'profile/aws',
                    ],
                    [
                        'id' => 2,
                        'text' => 'Database',
                        'url' => 'profile/database',
                    ],
                    [
                        'id' => 3,
                        'text' => 'CI/CD',
                        'url' => 'profile/cicd',
                    ],
                    [
                        'id' => 4,
                        'text' => 'Docker',
                        'url' => 'profile/docker',
                    ],
                    [
                        'id' => 5,
                        'text' => 'PHP Basic',
                        'url' => 'profile/php_basic',
                    ],
                    [
                        'id' => 6,
                        'text' => 'Git Basic',
                        'url' => 'profile/git_basic',
                    ],
                    [
                        'id' => 7,
                        'text' => 'Laravel',
                        'url' => 'profile/laravel',
                    ],
                    [
                        'id' => 8,
                        'text' => 'Design Pattern',
                        'url' => 'profile/designpattern',
                    ],
                    [
                        'id' => 9,
                        'text' => 'Criptografia',
                        'url' => 'profile/criptografia',
                    ],
                ],
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
    public function aws(Request $request)
    {
        return view(
            'aws',
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
