<?php

namespace Tests\Feature;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;
    // use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {
        Carbon::setTestNow('2021-03-23 14:00:00');
        parent::setUp();
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexSuccess()
    {
        // $response = $this->postJson('/user', ['name' => 'Sally']);
        // $this->json('POST', '/user', ['name' => 'Sally']);

        $excepted = factory(Course::class)->create();

        $response = $this->get('/api/courses');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    [
                    'name' => $excepted->name,
                    'description' => $excepted->description,
                    'outline' => $excepted->outline,
                    'students' => $excepted->students,
                    ]
                ]
            ]);
    }

    public function testGetSuccess()
    {
        $excepted = factory(Course::class)->create();

        $response = $this->get('/api/courses/2');

        $response->assertStatus(200)
            ->assertExactJson([
                'name' => $excepted->name,
                'description' => $excepted->description,
                'outline' => $excepted->outline,
            ]);
    }

    public function testGetFailed()
    {
        $response = $this->get('/api/courses/999');

        $response->assertStatus(404)
            ->assertExactJson([
                "message" => "找不到對應課程",
            ]);
    }

    public function testCreateSuccess()
    {
        $response = $this->json(
            'POST',
            '/api/courses/',
            [
                'name' => 'Sally',
                'description' => 'test',
                'outline' => 'outline',
            ]
        );

        $response->assertStatus(200)
            ->assertExactJson([
                "success" => [
                    'name' => 'Sally',
                    'description' => 'test',
                    'outline' => 'outline',
                    'updated_at' => '2021-03-23 14:00:00',
                    'created_at' => '2021-03-23 14:00:00',
                    'id' => 3,
                ]
            ]);
    }

    public function testCreateFailed()
    {
        $response = $this->json(
            'POST',
            '/api/courses/',
            [
                'description' => 'test',
                'outline' => 'outline',
            ]
        );

        $response->assertStatus(422)
            ->assertExactJson([
                "message" => "驗證錯誤",
            ]);
    }

    public function testUpdateSuccess()
    {
        Course::create([
            'id' => '4',
            'name' => '測試課程',
            'description' => 'test',
            'outline' => 'test',
        ]);

        $response = $this->json(
            'PUT',
            '/api/courses/4',
            [
                'name' => '測試課程',
                'description' => 'test',
                'outline' => 'outline',
            ]
        );

        $response->assertStatus(200)
            ->assertExactJson([
                'success' => true,
            ]);
    }

    public function testUpdateNoNameFailed()
    {
        Course::create([
            'id' => '5',
            'name' => '測試課程',
            'description' => 'test',
            'outline' => 'test',
        ]);

        $response = $this->json(
            'PUT',
            '/api/courses/5',
            [
                'description' => 'test',
                'outline' => 'outline',
            ]
        );

        $response->assertStatus(422)
            ->assertExactJson([
                "message" => "The given data was invalid.",
            ]);
    }

    public function testUpdateNotFindFailed()
    {
        $response = $this->json(
            'PUT',
            '/api/courses/999',
            [
                'name' => 'sad',
                'description' => 'test',
                'outline' => 'outline',
            ]
        );

        $response->assertStatus(404)
            ->assertExactJson([
                "message" => "課程找不到",
        ]);
    }

    public function testDeleteSuccess()
    {
        Course::create([
            'id' => '6',
            'name' => '測試課程',
            'description' => 'test',
            'outline' => 'test',
        ]);

        $response = $this->json(
            'delete',
            '/api/courses/6',
        );

        $response->assertStatus(200)
            ->assertExactJson([
                'success' => true,
            ]);
    }

    public function testDeleteFailed()
    {
        $response = $this->json(
            'delete',
            '/api/courses/999'
        );

        $response->assertStatus(404)
            ->assertExactJson([
                "message" => "找不到對應課程",
            ]);
    }
}
