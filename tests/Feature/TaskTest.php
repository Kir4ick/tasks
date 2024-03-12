<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_task_list()
    {
        $user = (new User())->setUuid(Str::uuid()->toString());

        $testCases = [
            [
                'statusCode' => 401,
                'isAuth' => false
            ],
            [
                'statusCode' => 200,
                'isAuth' => true
            ]
        ];

        foreach ($testCases as $testCase) {
            if ($testCase['isAuth']) {
                $this->actingAs($user);
            }

            $response = $this->get('/api/tasks', ['accept' => 'application/json']);
            $response->assertStatus($testCase['statusCode']);
        }
    }

    public function test_task_create()
    {
        $user = (new User())->setUuid(Str::uuid()->toString());

        $testCases = [
            [
                'statusCode' => 401,
                'isAuth' => false,
                'body' => [
                    'title' => 'test'
                ]
            ],
            [
                'statusCode' => 422,
                'isAuth' => true,
                'body' => [
                    'title' => 123231231
                ]
            ],
            [
                'statusCode' => 201,
                'isAuth' => true,
                'body' => [
                    'title' => 'Какая-то новая задача'
                ]
            ]
        ];

        foreach ($testCases as $testCase) {
            if ($testCase['isAuth']) {
                $this->actingAs($user);
            }

            $response = $this->postJson('/api/tasks', $testCase['body'], ['accept' => 'application/json']);
            $response->assertStatus($testCase['statusCode']);
        }
    }

}
