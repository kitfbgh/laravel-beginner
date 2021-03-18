<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
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
     *     path="/api/{id}",
     *     @OA\Response(response="200", description="拿取 課程資訊"),
     * )
     */
    public function course($id)
    {
        $course = Course::find($id);
        return $course;
    }

}
