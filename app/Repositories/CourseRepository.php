<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    /**
    * @var Course
    */
    private $model;

    /**
    * CourseService constructor.
    * @param Course $model
    */
    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    /**
    * @param int $id
    * @return Course
    */
    public function getCourseById($id)
    {
        return $this->model->find($id);
    }
}
