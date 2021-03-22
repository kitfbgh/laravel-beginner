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
/**
* @OA\server(
*      url = "https://api-host.dev.app",
*      description="測試區主機"
* )
* @OA\server(
*      url = "https://api-host.production.app",
*      description="正式區主機"
* )
* @OA\server(
*      url = "http://localhost",
*      description="Localhost"
* )
*/
class APIController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/profile",
     *     operationId="time",
     *     tags={"Time"},
     *     summary="取得此前時間 Summary",
     *     description="取得此前時間 Description",
     *     @OA\Response(
     *         response="200", 
     *         description="請求成功"
     *     ),
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
     *     path="/api/course/{id}",
     *     operationId="courseShow",
     *     tags={"Course"},
     *     summary="取得課程詳情",
     *     description="取得課程詳情",
     *     @OA\Parameter(
     *         name="id",
     *         description="Course id",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200", 
     *         description="請求成功"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="資源不存在",
     *     ),
     * )
     */
    public function course($id)
    {
        $course = Course::find($id);
        return $course;
    }

}
