<?php

namespace WiderFunnel\Collections;

use WiderFunnel\Items\Schedule;

/**
 * Class ScheduleCollection
 * @package WiderFunnel\Collections
 */
class ScheduleCollection extends CollectionAbstract
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

        return $collection->transform(function ($schedule) {
            return new Schedule($schedule);
        });
    }

    /**
     * @return static
     */
    public function active()
    {
        return $this->filter(function ($item) {
            return $item->status == Schedule::STATUS_ACTIVE;
        })->flatten(1);
    }

    /**
     * @return static
     */
    public function inactive()
    {
        return $this->filter(function ($item) {
            return $item->status == Schedule::STATUS_INACTIVE;
        })->flatten(1);
    }
}