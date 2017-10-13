<?php

namespace WiderFunnel\Collections;

use WiderFunnel\Items\Project;

/**
 * Class ProjectCollection
 * @package WiderFunnel\Collections
 */
class ProjectCollection extends CollectionAbstract
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

        return $collection->transform(function ($project) {
            return new Project($project);
        });
    }
}