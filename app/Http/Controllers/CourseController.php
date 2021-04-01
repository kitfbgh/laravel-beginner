<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Exception;
use App\Exceptions\APIException;
use App\Http\Resources\CourseResource;
use App\Services\CourseService;
use Illuminate\Support\Facades\Validator;

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

    public function index()
    {
        $courses = Course::all();
        return CourseResource::collection($courses);
    }

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
            throw new APIException('驗證錯誤', 422);
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

    public function update(Request $request, $courseId)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:20',
            ]);
        } catch (\Exception $e) {
            throw new APIException($e->getMessage(), 422);
        }

        if (! $course = Course::find($courseId)) {
            throw new APIException('課程找不到', 404);
        }
        $status = $course->update($request->toArray());
        return ['success' => $status];
    }

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
