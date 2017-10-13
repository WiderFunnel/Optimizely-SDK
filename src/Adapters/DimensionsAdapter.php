<?php

namespace WiderFunnel\Adapters;

use WiderFunnel\Items\Dimension;

/**
 * Class DimensionsAdapter
 * @package WiderFunnel
 */
class DimensionsAdapter extends AdapterAbstract
{
    /**
     * @param $dimensionId
     * @return static
     */
    public function find($dimensionId)
    {
        $response = $this->client->get("dimensions/{$dimensionId}");

        return Dimension::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->put("dimensions/{$this->getResourceId()}", $attributes);

        return Dimension::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $response = $this->client->delete("dimensions/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }
}