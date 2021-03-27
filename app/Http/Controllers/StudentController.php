<?php

namespace App\Http\Controllers;

use App\Exceptions\APIException;
use App\Http\Resources\StudentDataResource;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class StudentController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/Students",
     *     operationId="AllStudentsShow",
     *     tags={"Student"},
     *     summary="取得所有學生詳情",
     *     description="取得所有學生詳情",
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
     *         description="找不到學生",
     *     ),
     * )
     */
    public function index()
    {
        $students = Student::all();
        return StudentDataResource::collection($students);
    }

    /**
     * @OA\POST(
     *     path="/api/students",
     *     operationId="studentCreate",
     *     tags={"Student"},
     *     summary="新增學生",
     *     description="請求時需要附上JWT驗證",
     * 
     *     security={
     *         {
     *              "Authenticate": {}
     *         }
     *     },
     * 
     *     @OA\Parameter(
     *          name="firstname",
     *          description="性",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *               type="string"
     *          )
     *      ),
     * 
     *      @OA\Parameter(
     *           name="lastname",
     *           description="名",
     *           required=false,
     *           in="query",
     *           @OA\Schema(
     *               type="string"
     *           )
     *      ),
     * 
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
    * @param int $studentId
    * @return \Illuminate\Http\JsonResponse
    * @throws APIException
    * @throws \Exception
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            //$messages = $validator->errors()->getMessages();
            throw new APIException('驗證錯誤' , 422);
        }

        $studentForm = [
            'first_name' => $request->get('first_name'),
            'last_name' => trim($request->get('last_name')) ?? '',
            'register_at' => Carbon::now(),
        ];
        $status = Student::create($studentForm);

        return ['success' => $status];
    }

    /**
     * @OA\Get(
     *     path="/api/students/{studentId}",
     *     operationId="studentShow",
     *     tags={"Student"},
     *     summary="取得單一學生詳情",
     *     description="取得單一學生詳情",
     * 
     *     security={
     *          {
     *              "Authenticate": {}
     *          }
     *      },
     * 
     *     @OA\Parameter(
     *         name="studentId",
     *         description="Student Id",
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
     *         description="找不到對應學生",
     *     ),
     * )
     */
    /**
    * Display the specified resource.
    *
    * @param int $studentId
    * @return \Illuminate\Http\JsonResponse
    * @throws APIException
    * @throws \Exception
    */
    public function show($studentId)
    {
        if (! $student = Student::find($studentId)) {
            throw new APIException('找不到對應學生', 404);
        }
        return response()->json([
            'name' => $student->getFullNameAttribute(),
            'register_at' => $student['register_at'],
        ]);
    }


    /**
     * @OA\PUT(
     *      path="/api/students/{studentId}",
     *      operationId="studentUpdate",
     *      tags={"Student"},
     *      summary="更新學生資訊",
     *      description="更新學生資訊",
     * 
     *      security={
     *          {
     *              "Authenticate": {}
     *          }
     *      },
     * 
     *      @OA\Parameter(
     *          name="id",
     *          description="Student id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="firstname",
     *          description="性",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="lastname",
     *          description="名",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      
     *      @OA\Response(
     *          response=200,
     *          description="請求成功"
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="資源不存在"
     *       )
     * )
     * Update student content
     */
    public function update(Request $request, $studentId)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:20',
                'last_name' => 'required|string|max:20',
            ]);
        } catch (Exception $e) {
            throw new APIException($e->getMessage() , 422);
        }

        if (! $student = Student::find($studentId)) {
            throw new APIException('學生找不到', 404);
        }
        $status = $student->update($request->toArray());
        return ['success' => $status];
    }


    /**
     * @OA\Delete(
     *      path="/api/students/{studentId}",
     *      operationId="studentDelete",
     *      tags={"Student"},
     *      summary="刪除學生資訊",
     *      description="刪除學生資訊",
     * 
     *      security={
     *          {
     *               "Authenticate": {}
     *          }
     *      },
     * 
     *      @OA\Parameter(
     *          name="studentId",
     *          description="Student Id",
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
     * Delete student
     */
    public function destroy($studentId)
    {
        if (! $student = Student::find($studentId)) {
            throw new APIException('找不到對應學生', 404);
        }

        $status = $student->delete();
        return ['success' => $status];
    }
}
