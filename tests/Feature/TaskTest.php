<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tymon\JWTAuth\JWT;

class TaskTest extends TestCase
{
    public function test_create_task()
    {

        $testCases = [
            [
                'data' => [
                    'title' => 'иавгиаылоиа'
                ],
                'isError' => false,
                'statusCode' => 200
            ]
        ];

        foreach ($testCases as $testCase) {
            $response = $this->postJson('/api/tasks', $testCase['data']);
            dd($response);
        }
    }
}
