<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'grade',
    ];

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'student_course',
            'course_id',
            'student_id'
        );
    }

    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'student_course',
            'student_id',
            'course_id'
        );
    }
}
