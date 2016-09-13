<?php

/**
 * DIMENSIONS:
 */

// List dimensions in a project
$optimizely->project($projectId)->dimensions();

// Find a dimension
$optimizely->dimensions()->find($dimensionId);

// Create a dimension
$optimizely->project($projectId)->createDimension('My dimension');

// Update a dimension
$optimizely->dimension($dimensionId)->update([
    'name' => 'My new dimension name'
]);

// Delete a dimension
$optimizely->dimension($dimensionId)->delete();