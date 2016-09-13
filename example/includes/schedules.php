<?php

use Carbon\Carbon;

/**
 * SCHEDULES:
 */

// Find a schedule
$optimizely->schedules()->find($scheduleId);

// Update schedule
$optimizely->schedule($scheduleId)->update(
    Carbon::now()->addDays(30),
    Carbon::now()->addDays(60)
);

// Update start time of a given schedule
$optimizely->schedule($scheduleId)->startAt(Carbon::now()->addDays(30));

// Update stop time of a given schedule
$optimizely->schedule($scheduleId)->stopAt(Carbon::now()->addDays(30));

// List schedules for an experiment
$optimizely->experiment($experimentId)->schedules();

// List active schedules for an experiment
$optimizely->experiment($experimentId)->schedules()->active();

// List inactive schedules for an experiment
$optimizely->experiment($experimentId)->schedules()->inactive();

// Create a schedule for an experiment
$optimizely->experiment($experimentId)->schedule(Carbon::now()->addDays(10));

// Start an experiment at a given time
$optimizely->experiment($experimentId)->startAt(Carbon::now()->addDays(10));

// Stop an experiment at a given time
$optimizely->experiment($experimentId)->stopAt(Carbon::now()->addDays(10));

// Delete a schedule
$optimizely->schedule($scheduleId)->delete();