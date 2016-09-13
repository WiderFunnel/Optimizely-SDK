<?php

/**
 * AUDIENCES
 */

// List audiences in project
$optimizely->project($projectId)->audiences();

// Find an audience
$optimizely->audiences()->find($audienceId);

// Create an audience
$optimizely->project($projectId)->createAudience('My second audience');

// Update an audience
$optimizely->audience($audienceId)->update([
    'name' => 'My new name'
]);

// Delete an audience
// Not supported by Optimizely Rest API