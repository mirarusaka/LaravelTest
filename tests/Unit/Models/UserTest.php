<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Lesson;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
    * @param string $plan
    * @param int $remainingCount
    * @param int $reservationCount
    * @param bool $canReserve
    * @dataProvider dataCanReserve
    */
    public function testCanReserve(string $plan, int $capacity, int $remainingCount, int $reservationCount, bool $canReserve)
    {
        /** @var User $user */
        $user = Mockery::mock(new User());
        $user->shouldReceive('reservationCountThisMonth')->andReturn($reservationCount);
        $user->plan = $plan;

        /** @var Lesson $lesson */
        $lesson = Mockery::mock(Lesson::class);
        $lesson->shouldReceive('remainingCount')->andReturn($remainingCount);

        $this->assertSame($canReserve, $user->canReserve($lesson));
    }

    public function dataCanReserve()
    {
        return [
            '予約可:レギュラー,空きあり,月の上限以下' => [
                'plan' => 'regular',
                'capacity' => 2,
                'totalReservationCount' => 1,
                'userReservationCount' => 4,
                'canReserve' => true,
            ],
        ];
    }
}
