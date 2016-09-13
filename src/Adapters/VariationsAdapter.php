<?php

namespace Optimizely\Adapters;

use Optimizely\Items\Variation;

/**
 * Class VariationsAdapter
 * @package Optimizely
 */
class VariationsAdapter extends AdapterAbstract
{
    /**
     * @param $variationId
     * @return Variation
     */
    public function find($variationId)
    {
        $this->setResourceId($variationId);

        $response = $this->client->get("variations/{$this->getResourceId()}");

        return Variation::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $description
     * @return Variation
     */
    public function description($description)
    {
        return $this->update(compact('description'));
    }

    /**
     * @param array $attributes
     * @return Variation
     */
    public function update(array $attributes = [])
    {
        $response = $this->client->put("variations/{$this->getResourceId()}", $attributes);

        return Variation::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $weight
     * @return Variation
     */
    public function weight($weight)
    {
        return $this->update(compact('weight'));
    }

    /**
     * @param $js_component
     * @return Variation
     */
    public function js_component($js_component)
    {
        return $this->update(compact('js_component'));
    }

    /**
     * @return Variation
     */
    public function pause()
    {
        return $this->update(['is_paused' => true]);
    }

    /**
     * @return Variation
     */
    public function resume()
    {
        return $this->update(['is_paused' => false]);
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $response = $this->client->delete("variations/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }
}