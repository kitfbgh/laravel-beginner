<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Exception;
use App\Exceptions\APIException;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Support\Facades\Validator;

/**
*  @OA\SecurityScheme(
*         securityScheme="Authenticate",
*         type="apiKey",
*         in="header",
*         name="Authenticate"
*     )
*/
class CourseController extends Controller
{

    /**
    * @var CourseService
    */
    private $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/courses",
     *     operationId="AllCoursesShow",
     *     tags={"Course"},
     *     summary="取得所有課程詳情",
     *     description="取得所有課程詳情",
     * 
     *      security={
     *          {
     *               "Authenticate": {}
     *          }
     *      },
     * 
     *     @OA\Response(
     *         response="200", 
     *         description="請求成功"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="找不到課程",
     *     ),
     * )
     */
    public function index()
    {
        $courses = Course::all();
        return CourseResource::collection($courses);
    }

    /**
     * @OA\POST(
     *     path="/api/courses",
     *     operationId="courseCreate",
     *     tags={"Course"},
     *     summary="新增課程",
     *     description="請求時需要附上JWT驗證",
     * 
     *     security={
     *         {
     *              "Authenticate": {}
     *         }
     *     },
     * 
     *     @OA\Parameter(
     *          name="name",
     *          description="課程名稱",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *               type="string"
     *          )
     *      ),
     * 
     *      @OA\Parameter(
     *           name="description",
     *           description="課程描述",
     *           required=false,
     *           in="query",
     *           @OA\Schema(
     *               type="string"
     *           )
     *      ),
     * 
     *      @OA\Parameter(
     *           name="outline",
     *           description="課程大綱",
     *           required=false,
     *           in="query",
     *           @OA\Schema(
     *               type="string"
     *           )
     *      ),
     * 
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
    /**
    * Display the specified resource.
    *
    * @param int $courseId
    * @return \Illuminate\Http\JsonResponse
    * @throws APIException
    * @throws \Exception
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            //$messages = $validator->errors()->getMessages();
            throw new APIException('驗證錯誤' , 422);
        }

        $courseForm = [
            'name' => $request->get('name'),
            'description' => trim($request->get('description')) ?? '',
            'outline' => $request->get('outline') ?? '',
        ];
        $status = Course::create($courseForm);

        return ['success' => $status];
    }

    /**
     * @OA\Get(
     *     path="/api/courses/{courseId}",
     *     operationId="courseShow",
     *     tags={"Course"},
     *     summary="取得單一課程詳情",
     *     description="取得單一課程詳情",
     * 
     *     security={
     *          {
     *              "Authenticate": {}
     *          }
     *      },
     * 
     *     @OA\Parameter(
     *         name="courseId",
     *         description="Course Id",
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
     *         description="找不到對應課程",
     *     ),
     * )
     */
    /**
    * Display the specified resource.
    *
    * @param int $courseId
    * @return \Illuminate\Http\JsonResponse
    * @throws APIException
    * @throws \Exception
    */
    public function show($courseId)
    {
        try {
            $course = $this->service->getCourseById($courseId);
        } catch (Exception $e) {
            throw new APIException('找不到對應課程', 404);
        }
        return response()->json([
            'name' => $course->name,
            'description' => $course->description,
            'outline' => $course->outline,
        ]);
    }


    /**
     * @OA\PUT(
     *      path="/api/courses/{id}",
     *      operationId="courseUpdate",
     *      tags={"Course"},
     *      summary="更新課程",
     *      description="更新課程",
     * 
     *      security={
     *          {
     *              "Authenticate": {}
     *          }
     *      },
     * 
     *      @OA\Parameter(
     *          name="id",
     *          description="Course id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="課程名稱",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="課程描述",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="outline",
     *          description="課程大綱",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="請求成功"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="資源不存在"
     *       )
     * )
     * Update article content
     */
    public function update(Request $request, $courseId)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:20',
            ]);
        } catch (\Exception $e) {
            throw new APIException($e->getMessage() , 422);
        }

        if (! $course = Course::find($courseId)) {
            throw new APIException('課程找不到', 404);
        }
        $status = $course->update($request->toArray());
        return ['success' => $status];
    }


    /**
     * @OA\Delete(
     *      path="/api/courses/{courseId}",
     *      operationId="courseDelete",
     *      tags={"Course"},
     *      summary="刪除文章",
     *      description="刪除文章",
     * 
     *      security={
     *          {
     *               "Authenticate": {}
     *          }
     *      },
     * 
     *      @OA\Parameter(
     *          name="courseId",
     *          description="Course Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="請求成功"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="資源不存在"
     *       )
     * )
     * Delete course
     */
    public function destroy($courseId)
    {
        try {
            $course = $this->service->getCourseById($courseId);
        } catch (Exception $e) {
            throw new APIException('找不到對應課程', 404);
        }

        $status = $course->delete();
        return ['success' => $status];
    }

}
