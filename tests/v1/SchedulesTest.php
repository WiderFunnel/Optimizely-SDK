<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;

/**
 * Class SchedulesTest
 */
class SchedulesTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_schedules_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedules');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedules = $optimizely->experiment('1')->schedules();

        $this->assertInstanceOf(\GrowthOptimized\Collections\ScheduleCollection::class, $schedules);
        $this->assertObjectHasAttribute('items', $schedules);
        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedules->first());
        $this->assertObjectHasAttribute('id', $schedules->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedules'), $schedules->toJson());
    }

    /** @test */
    public function it_can_fetch_the_list_of_active_schedules_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedules');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedules = $optimizely->experiment('1')->schedules();

        $this->assertJsonStringEqualsJsonFile(
            $this->getStub('schedules/active-schedules'),
            $schedules->active()->toJson()
        );
    }

    /** @test */
    public function it_can_fetch_the_list_of_inactive_schedules_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedules');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedules = $optimizely->experiments()->schedules('1');

        $this->assertJsonStringEqualsJsonFile(
            $this->getStub('schedules/inactive-schedules'),
            $schedules->inactive()->toJson()
        );
    }

    /** @test */
    public function it_can_fetch_a_schedule()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->schedules()->find('1');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_create_a_schedule_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->experiment('1')->schedule('2015-01-01T08:00:00Z', '2015-01-01T08:00:00Z');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_create_a_schedule_with_a_carbon_object_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->experiment('1')->schedule(\Carbon\Carbon::now()->addDays(10));

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_create_a_schedule_with_start_time_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->experiment('1')->startAt('2015-01-01T08:00:00Z');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_create_a_schedule_with_stop_time_only_in_an_experiment()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->experiment('1')->stopAt('2015-01-01T08:00:00Z');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_update_a_schedule()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->schedule('1')->update('2015-01-01T08:00:00Z');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_update_the_start_time_of_a_schedule()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->schedule('1')->startAt('2015-01-01T08:00:00Z');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_update_the_stop_time_of_a_schedule()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->schedule('1')->stopAt('2015-01-01T08:00:00Z');

        $this->assertInstanceOf(\GrowthOptimized\Items\Schedule::class, $schedule);
        $this->assertJsonStringEqualsJsonFile($this->getStub('schedules/schedule'), $schedule->toJson());
    }

    /** @test */
    public function it_can_delete_a_schedule()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $schedule = $optimizely->schedule('1')->delete();

        $this->assertTrue($schedule);
    }
}