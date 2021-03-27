<?php

namespace Tests\Feature;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class StudentTest extends TestCase
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

        $excepted = factory(Student::class)->create();

        $response = $this->get('/api/students');

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    [
                    'first_name' => $excepted->first_name,
                    'last_name' => $excepted->last_name,
                    'register_at' => $excepted->register_at,
                    ]
                ]
                
            ]);
    }

    public function testGetSuccess()
    {
        $excepted = factory(Student::class)->create();

        $response = $this->get('/api/students/2');

        $response->assertStatus(200)
            ->assertExactJson([
                
                'name' => $excepted->first_name.' '.$excepted->last_name,
                'register_at' => $excepted->register_at,
                
            ]);
    }

    public function testGetFailed()
    {
        
        $response = $this->get('/api/students/999');

        $response->assertStatus(404)
            ->assertExactJson([
                "message" => "找不到對應學生",
            ]);
    }

    public function testCreateSuccess()
    {
        $response = $this->json(
            'POST',
            '/api/students/', 
            [
                'first_name' => 'sally',
                'last_name' => 'test',
                'register_at' => Carbon::now(),
            ]

        );

        $response->assertStatus(200)
            ->assertExactJson([
                "success" => [
                    'first_name' => 'sally',
                    'last_name' => 'test',
                    'register_at' => '2021-03-23 14:00:00',
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
            '/api/students/', 
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
        Student::create([
            'id' => '4',
            'first_name' => '測試課程',
            'last_name' => 'test',
            'register_at' => Carbon::now(),
        ]);

        $response = $this->json(
            'PUT',
            '/api/students/4', 
            [
                'first_name' => '測試課程',
                'last_name' => 'test',
                'register_at' => '2021-03-23 14:00:00',
            ]

        );

        $response->assertStatus(200)
            ->assertExactJson([
                
                    'success'=>true,
                
            ]);

    }

    public function testUpdateNoNameFailed()
    {
        Student::create([
            'id' => '5',
            'first_name' => '測試課程',
            'last_name' => 'test',
            'register_at' => Carbon::now(),
        ]);

        $response = $this->json(
            'PUT',
            '/api/students/5', 
            [
                'description' => 'test',
                'outline' => 'outline',
            ]

        );

        $response->assertStatus(422)
            ->assertExactJson([
                
                "message"=> "The given data was invalid.",
                
            ]);
    }

    public function testUpdateNotFindFailed()
    {
        $response = $this->json(
            'PUT',
            '/api/students/999', 
            [
                'first_name' => 'sad',
                'last_name' => 'test',
                'register_at' => Carbon::now(),
            ]

        );

        $response->assertStatus(404)
            ->assertExactJson([
            
                "message"=> "學生找不到",
            
        ]); 
    }

    public function testDeleteSuccess()
    {
        Student::create([
            'id' => '6',
            'first_name' => '測試課程',
            'last_name' => 'test',
            'register_at' => Carbon::now(),
        ]);

        $response = $this->json(
            'delete',
            '/api/students/6', 
        );

        $response->assertStatus(200)
            ->assertExactJson([
            
                'success'=>true,
            
            ]); 
    }

    public function testDeleteFailed()
    {
        $response = $this->json(
            'delete',
            '/api/students/999'
        );

        $response->assertStatus(404)
            ->assertExactJson([
                "message" => "找不到對應學生",
            ]);
    }
}
