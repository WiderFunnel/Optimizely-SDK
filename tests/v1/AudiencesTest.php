<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;

/**
 * Class AudiencesTest
 */
class AudiencesTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_audiences_in_a_project()
    {
        $client = $this->fakeClient('audiences/audiences');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $audiences = $optimizely->projects()->audiences('1');

        $this->assertInstanceOf(\GrowthOptimized\Collections\AudienceCollection::class, $audiences);
        $this->assertObjectHasAttribute('items', $audiences);
        $this->assertInstanceOf(\GrowthOptimized\Items\Audience::class, $audiences->first());
        $this->assertObjectHasAttribute('id', $audiences->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audiences'), $audiences->toJson());
    }

    /** @test */
    public function it_can_fetch_an_audience()
    {
        $client = $this->fakeClient('audiences/audience');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $audience = $optimizely->audiences()->find('1');

        $this->assertInstanceOf(\GrowthOptimized\Items\Audience::class, $audience);
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audience'), $audience->toJson());
    }

    /** @test */
    public function it_can_create_an_audience_in_a_project()
    {
        $client = $this->fakeClient('audiences/audience');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $audience = $optimizely->project('1')->createAudience("Canadians");

        $this->assertInstanceOf(\GrowthOptimized\Items\Audience::class, $audience);
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audience'), $audience->toJson());
    }

    /** @test */
    public function it_can_update_an_audience()
    {
        $client = $this->fakeClient('audiences/audience');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $audience = $optimizely->audience('1')->update(['name' => 'Canadians']);

        $this->assertInstanceOf(\GrowthOptimized\Items\Audience::class, $audience);
        $this->assertJsonStringEqualsJsonFile($this->getStub('audiences/audience'), $audience->toJson());
    }
}