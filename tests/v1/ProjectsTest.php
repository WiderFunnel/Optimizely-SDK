<?php

namespace GrowthOptimized\Tests\v1;

use GrowthOptimized\Tests\TestCase;

/**
 * Class ProjectsTest
 */
class ProjectsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_projects()
    {
        $client = $this->fakeClient('projects/projects');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $projects = $optimizely->projects()->all();

        $this->assertInstanceOf(\GrowthOptimized\Collections\ProjectCollection::class, $projects);
        $this->assertObjectHasAttribute('items', $projects);
        $this->assertInstanceOf(\GrowthOptimized\Items\Project::class, $projects->first());
        $this->assertObjectHasAttribute('id', $projects->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('projects/projects'), $projects->toJson());
    }

    /** @test */
    public function it_can_fetch_a_project()
    {
        $client = $this->fakeClient('projects/project');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $project = $optimizely->projects()->find('1');

        $this->assertInstanceOf(\GrowthOptimized\Items\Project::class, $project);
        $this->assertJsonStringEqualsJsonFile($this->getStub('projects/project'), $project->toJson());
    }

    /** @test */
    public function it_can_create_a_project()
    {
        $client = $this->fakeClient('projects/project');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $project = $optimizely->projects()->create('My even newer project name');

        $this->assertInstanceOf(\GrowthOptimized\Items\Project::class, $project);
        $this->assertJsonStringEqualsJsonFile($this->getStub('projects/project'), $project->toJson());
    }

    /** @test */
    public function it_can_update_a_project()
    {
        $client = $this->fakeClient('projects/project');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $project = $optimizely->project('1')->update(['project_name' => 'My even newer project name']);

        $this->assertInstanceOf(\GrowthOptimized\Items\Project::class, $project);
        $this->assertJsonStringEqualsJsonFile($this->getStub('projects/project'), $project->toJson());
    }

    /** @test */
    public function it_can_activate_a_project()
    {
        $client = $this->fakeClient('projects/project');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $project = $optimizely->project('1')->activate();

        $this->assertInstanceOf(\GrowthOptimized\Items\Project::class, $project);
        $this->assertJsonStringEqualsJsonFile($this->getStub('projects/project'), $project->toJson());
    }

    /** @test */
    public function it_can_archive_a_project()
    {
        $client = $this->fakeClient('projects/project');

        $optimizely = new \GrowthOptimized\Optimizely($client);
        $project = $optimizely->project('1')->archive();

        $this->assertInstanceOf(\GrowthOptimized\Items\Project::class, $project);
        $this->assertJsonStringEqualsJsonFile($this->getStub('projects/project'), $project->toJson());
    }
}