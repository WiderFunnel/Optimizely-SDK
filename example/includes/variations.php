<?php

/**
 * VARIATIONS:
 */

// Fetch variations for a given experiment
$optimizely->experiment($experimentId)->variations();

// Find a variation
$optimizely->variations()->find($variationId);

// Update a variation
$optimizely->variation($variationId)->update(['description' => 'Control']);

// Update variation description
$optimizely->variation($variationId)->description('Variation A');

// Update variation weight
$optimizely->variation($variationId)->weight(5000);

// Update variation JS component
$optimizely->variation($variationId)->js_component('$(".selector")');

// Pause variation
$optimizely->variation($variationId)->pause();

// Resume variation
$optimizely->variation($variationId)->resume();

// Delete a variation
$optimizely->variation($variationId)->delete();