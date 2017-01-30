<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;
use GrowthOptimized\Items\Goal;

/**
 * Class GoalsTest
 */
class GoalsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_goals_in_a_project()
    {
        $client = $this->fakeClient('goals/goals');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $goals = $optimizely->projects()->goals('1');

        $this->assertInstanceOf(\GrowthOptimized\Collections\GoalCollection::class, $goals);
        $this->assertObjectHasAttribute('items', $goals);
        $this->assertInstanceOf(Goal::class, $goals->first());
        $this->assertObjectHasAttribute('id', $goals->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('goals/goals'), $goals->toJson());
    }

    /** @test */
    public function it_can_fetch_an_goal()
    {
        $client = $this->fakeClient('goals/goal');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $goal = $optimizely->goals()->find('1');

        $this->assertInstanceOf(Goal::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('goals/goal'), $goal->toJson());
    }

    /** @test */
    public function it_can_create_an_goal_in_a_project()
    {
        $client = $this->fakeClient('goals/goal');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $goal = $optimizely->projects('1')->createGoal("Canadians", Goal::TYPE_CLICK);

        $this->assertInstanceOf(Goal::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('goals/goal'), $goal->toJson());
    }

    /** @test */
    public function it_can_update_an_goal()
    {
        $client = $this->fakeClient('goals/goal');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $goal = $optimizely->goals('1')->update(['name' => 'Canadians']);

        $this->assertInstanceOf(Goal::class, $goal);
        $this->assertJsonStringEqualsJsonFile($this->getStub('goals/goal'), $goal->toJson());
    }

    /** @test */
    public function it_can_delete_a_goal()
    {
        $client = $this->fakeClient('goals/goal');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $goal = $optimizely->goal('1')->delete();

        $this->assertTrue($goal);
    }
}