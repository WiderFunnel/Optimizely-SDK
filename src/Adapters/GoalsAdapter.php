<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Items\Goal;

/**
 * Class GoalsAdapter
 * @package GrowthOptimized
 */
class GoalsAdapter extends AdapterAbstract
{
    /**
     * @param $goalId
     * @return static
     */
    public function find($goalId = null)
    {
        $this->setResourceId($goalId);

        $response = $this->client->get("goals/{$this->getResourceId()}");

        return Goal::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->put("goals/{$this->getResourceId()}", $attributes);

        return Goal::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function delete()
    {
        $response = $this->client->delete("goals/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }
}