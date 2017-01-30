<?php

namespace GrowthOptimized\Collections;

use GrowthOptimized\Items\Audience;

/**
 * Class AudienceCollection
 * @package GrowthOptimized\Collections
 */
class AudienceCollection extends CollectionAbstract
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

        return $collection->transform(function ($audience) {
            return new Audience($audience);
        });
    }
}