<?php

namespace Optimizely\Collections;

use Optimizely\Items\Audience;

/**
 * Class AudienceCollection
 * @package Optimizely\Collections
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