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
    public function index()
    {
        $students = Student::all();
        return StudentDataResource::collection($students);
    }

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
            throw new APIException('驗證錯誤', 422);
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

    public function update(Request $request, $studentId)
    {
        try {
            $request->validate([
                'first_name' => 'required|string|max:20',
                'last_name' => 'required|string|max:20',
            ]);
        } catch (Exception $e) {
            throw new APIException($e->getMessage(), 422);
        }

        if (! $student = Student::find($studentId)) {
            throw new APIException('學生找不到', 404);
        }
        $status = $student->update($request->toArray());
        return ['success' => $status];
    }

    public function destroy($studentId)
    {
        if (! $student = Student::find($studentId)) {
            throw new APIException('找不到對應學生', 404);
        }

        $status = $student->delete();
        return ['success' => $status];
    }
}
