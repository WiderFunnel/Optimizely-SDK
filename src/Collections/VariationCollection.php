<?php

namespace Optimizely\Collections;

use Optimizely\Items\Variation;

/**
 * Class VariationCollection
 * @package Optimizely\Collections
 */
class VariationCollection extends CollectionAbstract
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

        return $collection->transform(function ($variation) {
            return new Variation($variation);
        });
    }
}