<?php
namespace App\Services;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Repositories\CourseRepository;
use Exception;
use App\Exceptions\APIException;

class CourseService
{
    /**
    * @var CourseRepository
    */
    private $repo;

    /**
    * CourseService constructor.
    * @param CourseRepository $repo
    */
    public function __construct(CourseRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
    * @param int $id
    * @return CourseResource
    */
    public function getCourseById($id): CourseResource
    {
        if (empty($id)) {
            throw new Exception('invalid course id');
        }
        if (! $course = $this->repo->getCourseById($id)) {
            throw new APIException('找不到對應課程', 404);
        }

        return new CourseResource($course);
    }
}