<?php

namespace GrowthOptimized\Items;

/**
 * Class Experiment
 * @package GrowthOptimized\Items;
 */
class Experiment extends ItemAbstract
{
    // Statuses
    const STATUS_LIVE = 'Running';
    const STATUS_PAUSED = 'Paused';
    const STATUS_NOT_STARTED = 'Not started';
    const STATUS_ARCHIVED = 'Archived';
}