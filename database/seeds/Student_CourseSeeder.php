<?php

use App\Models\Student_Course;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Student_CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_course = Course::all();
        $all_student = Student::all();
        $courses_count = count($all_course);
        $students_count = count($all_student);
        $i = 1;
        while (true) {
            if($i > 15) break;
            $studentID_rand = rand(1, $students_count);
            $courseID_rand = rand(1, $courses_count);
            $sql = 'select * from student_course where student_id = '.strval($studentID_rand).' and course_id = '.strval($courseID_rand);
            $data = DB::select($sql);
            if(count($data) === 0)
            {
                Student_Course::create([
                    'id' => $i,
                    'student_id' => $studentID_rand,
                    'course_id' => $courseID_rand,
                    'grade' => rand(0, 100),
                ]);
                $i++;
            }
        }
    }
}
