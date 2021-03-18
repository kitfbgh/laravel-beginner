<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="104-Project OpenApi",
 *      description="104-Project OpenApi description",
 *      @OA\Contact(
 *          email="a8732987@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 */
class APIController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/profile/info",
     *     @OA\Response(response="200", description="獲取現在時間"),
     * )
     */
    public function profile(Request $request)
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
     * @OA\Get(
     *     path="/api/aws/info",
     *     @OA\Response(response="200", description="拿取 AWS 課程資訊"),
     * )
     */
    public function aws(Request $request)
    {
        return ['course' => 'AWS'];
    }

    /**
     * @OA\Get(
     *     path="/api/cicd/info",
     *     @OA\Response(response="200", description="拿取 CI/CD 課程資訊"),
     * )
     */
    public function cicd(Request $request)
    {
        return ['course' => 'CI/CD'];
    }

    /**
     * @OA\Get(
     *     path="/api/criptografia/info",
     *     @OA\Response(response="200", description="拿取 Criptografia 課程資訊"),
     * )
     */
    public function criptografia(Request $request)
    {
        return ['course' => 'Criptografia'];
    }

    /**
     * @OA\Get(
     *     path="/api/database/info",
     *     @OA\Response(response="200", description="拿取 Database 課程資訊"),
     * )
     */
    public function database(Request $request)
    {
        return ['course' => 'Database'];
    }

    /**
     * @OA\Get(
     *     path="/api/designpattern/info",
     *     @OA\Response(response="200", description="拿取 Design Pattern 課程資訊"),
     * )
     */
    public function designpattern(Request $request)
    {
        return ['course' => 'Design Pattern'];
    }

    /**
     * @OA\Get(
     *     path="/api/docker/info",
     *     @OA\Response(response="200", description="拿取 Docker 課程資訊"),
     * )
     */
    public function docker(Request $request)
    {
        return ['course' => 'Docker'];
    }

    /**
     * @OA\Get(
     *     path="/api/git_basic/info",
     *     @OA\Response(response="200", description="拿取 Git Basic 課程資訊"),
     * )
     */
    public function git_basic(Request $request)
    {
        return ['course' => 'Git Basic'];
    }

    /**
     * @OA\Get(
     *     path="/api/laravel/info",
     *     @OA\Response(response="200", description="拿取 Laravel 課程資訊"),
     * )
     */
    public function laravel(Request $request)
    {
        return ['course' => 'Laravel'];
    }

    /**
     * @OA\Get(
     *     path="/api/php_basic/info",
     *     @OA\Response(response="200", description="拿取 PHP Basic 課程資訊"),
     * )
     */
    public function php_basic(Request $request)
    {
        return ['course' => 'PHP Basic'];
    }
}
