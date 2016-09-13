<?php

namespace Optimizely\Collections;

use Optimizely\Items\Result;

/**
 * Class ResultCollection
 * @package Optimizely\Collections
 */
class ResultCollection extends CollectionAbstract
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

        return $collection->transform(function ($result) {
            return new Result($result);
        });
    }
}