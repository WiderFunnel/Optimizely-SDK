<?php

namespace WiderFunnel\Collections;

use WiderFunnel\Items\UploadedList;

/**
 * Class UploadedListCollection
 * @package WiderFunnel\Collections
 */
class UploadedListCollection extends CollectionAbstract
{
    /**
     * @param $json
     * @return mixed
     */
    public static function createFromJson($json)
    {
        if (!is_array($json)) {
            $json = json_decode($json, JSON_OBJECT_AS_ARRAY);
        }

        $collection = new static($json);

        return $collection->transform(function ($uploadedList) {
            return new UploadedList($uploadedList);
        });
    }
}