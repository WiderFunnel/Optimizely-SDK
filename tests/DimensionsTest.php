<?php

/**
 * Class DimensionsTest
 */
class DimensionsTest extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_dimensions_in_a_project()
    {
        $client = $this->fakeClient('dimensions/dimensions');

        $optimizely = new \Optimizely\Optimizely($client);
        $dimensions = $optimizely->projects()->dimensions('1');

        $this->assertInstanceOf(\Optimizely\Collections\DimensionCollection::class, $dimensions);
        $this->assertObjectHasAttribute('items', $dimensions);
        $this->assertInstanceOf(\Optimizely\Items\Dimension::class, $dimensions->first());
        $this->assertObjectHasAttribute('id', $dimensions->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('dimensions/dimensions'), $dimensions->toJson());
    }

    /** @test */
    public function it_can_fetch_an_dimension()
    {
        $client = $this->fakeClient('dimensions/dimension');

        $optimizely = new \Optimizely\Optimizely($client);
        $dimension = $optimizely->dimensions()->find('1');

        $this->assertInstanceOf(\Optimizely\Items\Dimension::class, $dimension);
        $this->assertJsonStringEqualsJsonFile($this->getStub('dimensions/dimension'), $dimension->toJson());
    }

    /** @test */
    public function it_can_create_an_dimension_in_a_project()
    {
        $client = $this->fakeClient('dimensions/dimension');

        $optimizely = new \Optimizely\Optimizely($client);
        $dimension = $optimizely->project('1')->createDimension("Canadians");

        $this->assertInstanceOf(\Optimizely\Items\Dimension::class, $dimension);
        $this->assertJsonStringEqualsJsonFile($this->getStub('dimensions/dimension'), $dimension->toJson());
    }

    /** @test */
    public function it_can_update_an_dimension()
    {
        $client = $this->fakeClient('dimensions/dimension');

        $optimizely = new \Optimizely\Optimizely($client);
        $dimension = $optimizely->dimension('1')->update(['name' => 'Canadians']);

        $this->assertInstanceOf(\Optimizely\Items\Dimension::class, $dimension);
        $this->assertJsonStringEqualsJsonFile($this->getStub('dimensions/dimension'), $dimension->toJson());
    }

    /** @test */
    public function it_can_delete_a_dimension()
    {
        $client = $this->fakeClient('dimensions/dimension');

        $optimizely = new \Optimizely\Optimizely($client);
        $dimension = $optimizely->dimension('1')->delete();

        $this->assertTrue($dimension);
    }
}