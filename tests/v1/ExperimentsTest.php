<?php

namespace Optimizely\Tests\v1;

use Optimizely\Tests\TestCase;

/**
 * Class ExperimentsTest
 */
class ExperimentsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_experiments_in_a_project()
    {
        $client = $this->fakeClient('experiments/experiments');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiments = $optimizely->project('1')->experiments();

        $this->assertInstanceOf(\Optimizely\Collections\ExperimentCollection::class, $experiments);
        $this->assertObjectHasAttribute('items', $experiments);
        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiments->first());
        $this->assertObjectHasAttribute('id', $experiments->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiments'), $experiments->toJson());
    }

    /** @test */
    public function it_can_fetch_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiments()->find('1');

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_create_an_experiment_in_a_project()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->project('1')->createExperiment(
            "My Experiment Name",
            "https://mysite.com/products/",
            ['status' => 'Paused']
        );

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_update_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiment('1')->update([
            'description' => 'Wordpress: 10 Reasons Why Your Agency Should Offer Optimization '
        ]);

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_launch_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiment('1')->launch();

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_pause_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiment('1')->pause();

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_resume_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiment('1')->resume();

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_archive_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiment('1')->archive();

        $this->assertInstanceOf(\Optimizely\Items\Experiment::class, $experiment);
        $this->assertJsonStringEqualsJsonFile($this->getStub('experiments/experiment'), $experiment->toJson());
    }

    /** @test */
    public function it_can_delete_an_experiment()
    {
        $client = $this->fakeClient('experiments/experiment');

        $optimizely = new \Optimizely\Optimizely($client);
        $experiment = $optimizely->experiment('1')->delete();

        $this->assertTrue($experiment);
    }

    /** @test */
    public function it_can_fetch_an_experiment_results()
    {
        $client = $this->fakeClient('results/results');

        $optimizely = new \Optimizely\Optimizely($client);
        $results = $optimizely->experiment('1')->results();

        $this->assertInstanceOf(\Optimizely\Collections\ResultCollection::class, $results);
        $this->assertObjectHasAttribute('items', $results);
        $this->assertInstanceOf(\Optimizely\Items\Result::class, $results->first());
        $this->assertObjectHasAttribute('variation_id', $results->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('results/results'), $results->toJson());
    }

    /** @test */
    public function it_can_fetch_an_experiment_legacy_results()
    {
        $client = $this->fakeClient('results/results');

        $optimizely = new \Optimizely\Optimizely($client);
        $results = $optimizely->experiment('1')->legacyResults();

        $this->assertInstanceOf(\Optimizely\Collections\ResultCollection::class, $results);
        $this->assertObjectHasAttribute('items', $results);
        $this->assertInstanceOf(\Optimizely\Items\Result::class, $results->first());
        $this->assertObjectHasAttribute('variation_id', $results->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('results/results'), $results->toJson());
    }
}