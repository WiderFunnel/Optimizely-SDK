<?php

/**
 * GOALS:
 */

// List goals in project
$optimizely->project($projectId)->goals();

// Find a goal
$optimizely->goals()->find($goalId);

// Create a goal in a project
$optimizely->project($projectId)->createGoal('My new goal', 1, [
    'event' => 'My event'
]);

// Delete a goal
$optimizely->goal($goalId)->delete();