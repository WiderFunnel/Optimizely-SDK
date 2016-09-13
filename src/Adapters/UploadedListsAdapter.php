<?php

namespace Optimizely\Adapters;

use Optimizely\Items\UploadedList;

/**
 * Class UploadedListsAdapter
 * @package Optimizely
 */
class UploadedListsAdapter extends AdapterAbstract
{
    /**
     * @param $uploadedListId
     * @return static
     */
    public function find($uploadedListId)
    {
        $response = $this->client->get("targeting_lists/{$uploadedListId}");

        return UploadedList::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->put("targeting_lists/{$this->getResourceId()}", $attributes);

        return UploadedList::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return static
     */
    public function delete()
    {
        $response = $this->client->delete("targeting_lists/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }
}