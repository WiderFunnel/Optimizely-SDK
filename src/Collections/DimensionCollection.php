<?php

namespace GrowthOptimized\Collections;

use GrowthOptimized\Items\Dimension;

/**
 * Class DimensionCollection
 * @package GrowthOptimized\Collections
 */
class DimensionCollection extends CollectionAbstract
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

        return $collection->transform(function ($dimension) {
            return new Dimension($dimension);
        });
    }
}