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
                        'text' => 'AWS雲端基礎概論',
                        'url' => '/aws',
                    ],
                    [
                        'id' => 2,
                        'text' => '認識資料庫 L1 + SQL語法',
                        'url' => '/database',
                    ],
                    [
                        'id' => 3,
                        'text' => 'CI/CD 基礎概念',
                        'url' => '/cicd',
                    ],
                    [
                        'id' => 4,
                        'text' => 'Docker 入門篇',
                        'url' => '/docker',
                    ],
                    [
                        'id' => 5,
                        'text' => 'PHP 基礎課程(E)',
                        'url' => '/php_basic',
                    ],
                    [
                        'id' => 6,
                        'text' => 'Git 入門篇(C)',
                        'url' => '/git_basic',
                    ],
                    [
                        'id' => 7,
                        'text' => 'Laravel 程式設計(I)',
                        'url' => '/laravel',
                    ],
                    [
                        'id' => 8,
                        'text' => '設計模式基礎',
                        'url' => '/designpattern',
                    ],
                    [
                        'id' => 9,
                        'text' => '密碼學基本原理 + 弱點掃描概論',
                        'url' => '/criptografia',
                    ],
                    [
                        'id' => 10,
                        'text' => '良好的程式撰寫基礎',
                        'url' => '/goodcode',
                    ],
                    [
                        'id' => 11,
                        'text' => '搜尋引琴',
                        'url' => '/searchengine',
                    ],
                    [
                        'id' => 12,
                        'text' => 'AWS持續整合與部署CI/CD',
                        'url' => '/aws_cicd',
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
