<?php

namespace Tests\Unit;

use App\Exceptions\Api\AccessDeniedException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\NotFoundException;
use App\Models\User;
use App\Repositories\Contracts\ITaskRepository;
use App\Services\Contracts\ITaskService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use PHPUnit\Framework\Assert;
use Tests\TestCase;

class TaskTest extends TestCase
{

    public function test_create_task()
    {
        /** @var ITaskService $service */
        $service = resolve(ITaskService::class);
        /** @var ITaskRepository $repository */
        $repository = resolve(ITaskRepository::class);

        $this->actingAs((new User())->setUuid(Str::uuid()->toString()));

        $testCases = [
            [
                'isError' => false,
                'data' => ['title' => 'какая-то нова задача'],
            ],
        ];

        foreach ($testCases as $testCase) {
            $result = $service->create($testCase['data']);

            $this->assertTrue($result?->is($repository->one($result->id)));
        }
    }

    public function test_update_task()
    {
        /** @var ITaskService $service */
        $service = resolve(ITaskService::class);
        /** @var ITaskRepository $repository */
        $repository = resolve(ITaskRepository::class);

        $this->actingAs((new User())->setUuid(Str::uuid()->toString()));
        $old_task = $service->create(['title' => 'какая-то нова задача']);

        $this->actingAs((new User())->setUuid(Str::uuid()->toString()));
        $new_task = $service->create(['title' => 'какая-то нова задача 2']);

        $testCases = [
            [
                'isError' => false,
                'uuid' => $new_task->id,
                'data' => ['status' => 'done']
            ],
            [
                'isError' => true,
                'data' => ['status' => 'done'],
                'uuid' => $old_task->id,
                'exception' => AccessDeniedException::class
            ],
            [
                'isError' => true,
                'data' => [],
                'uuid' => $new_task->id,
                'exception' => BadRequestException::class
            ],
            [
                'isError' => true,
                'data' => ['status' => 'done'],
                'uuid' => '5b4b3fde-4da9-4ee2-a721-7fdca50a9d33',
                'exception' => NotFoundException::class
            ],
        ];

        foreach ($testCases as $testCase) {
            if ($testCase['isError']) {
                $this->assertThrows(function () use ($service, $testCase) {
                    return $service->update($testCase['uuid'], $testCase['data']);
                }, $testCase['exception']);

                continue;
            }

            $result = $service->update($testCase['uuid'], $testCase['data']);

            $this->assertTrue($result?->is($repository->one($result->id)));
        }
    }

    public function test_delete_task()
    {
        /** @var ITaskService $service */
        $service = resolve(ITaskService::class);
        /** @var ITaskRepository $repository */
        $repository = resolve(ITaskRepository::class);

        $this->actingAs((new User())->setUuid(Str::uuid()->toString()));
        $old_task = $service->create(['title' => 'какая-то нова задача']);

        $this->actingAs((new User())->setUuid(Str::uuid()->toString()));
        $new_task = $service->create(['title' => 'какая-то нова задача 2']);

        $testCases = [
            [
                'isError' => false,
                'uuid' => $new_task->id,
            ],
            [
                'isError' => true,
                'uuid' => $old_task->id,
                'exception' => AccessDeniedException::class
            ],
            [
                'isError' => true,
                'uuid' => '5b4b3fde-4da9-4ee2-a721-7fdca50a9d33',
                'exception' => NotFoundException::class
            ],
        ];

        foreach ($testCases as $testCase) {
            if ($testCase['isError']) {
                $this->assertThrows(function () use ($service, $testCase) {
                    return $service->delete($testCase['uuid']);
                }, $testCase['exception']);

                continue;
            }

            $result = $service->delete($testCase['uuid']);

            $this->assertNotTrue($result?->is($repository->one($result->id)));
        }
    }
}
