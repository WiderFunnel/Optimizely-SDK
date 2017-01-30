<?php

namespace GrowthOptimized\Adapters;

use GrowthOptimized\Items\Audience;

/**
 * Class AudiencesAdapter
 * @package GrowthOptimized
 */
class AudiencesAdapter extends AdapterAbstract
{
    /**
     * @param $audienceId
     * @return static
     */
    public function find($audienceId = null)
    {
        $this->setResourceId($audienceId);

        $response = $this->client->get("audiences/{$this->getResourceId()}");

        return Audience::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->put("audiences/{$this->getResourceId()}", $attributes);

        return Audience::createFromJson($response->getBody()->getContents());
    }
}