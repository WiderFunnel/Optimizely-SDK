<?php

namespace WiderFunnel\Adapters;

use WiderFunnel\Items\Schedule;

/**
 * Class SchedulesAdapter
 * @package WiderFunnel
 */
class SchedulesAdapter extends AdapterAbstract
{
    /**
     * @param $scheduleId
     * @return static
     */
    public function find($scheduleId)
    {
        $this->setResourceId($scheduleId);

        $response = $this->client->get("schedules/{$this->getResourceId()}");

        return Schedule::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $start_time
     * @return Schedule
     */
    public function startAt($start_time)
    {
        return $this->update($start_time);
    }

    /**
     * @param $start_time
     * @param $stop_time
     * @return static
     */
    public function update($start_time = null, $stop_time = null)
    {
        $start_time = $this->normalizeDate($start_time);
        $stop_time = $this->normalizeDate($stop_time);

        $attributes = array_filter(
            compact('start_time', 'stop_time')
        );

        $response = $this->client->put("schedules/{$this->getResourceId()}", $attributes);

        return Schedule::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $stop_time
     * @return Schedule
     */
    public function stopAt($stop_time)
    {
        return $this->update(null, $stop_time);
    }

    /**
     * @return static
     */
    public function delete()
    {
        $response = $this->client->delete("schedules/{$this->getResourceId()}");

        return $this->booleanResponse($response);
    }
}