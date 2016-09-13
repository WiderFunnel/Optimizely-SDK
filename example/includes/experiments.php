<?php

/**
 * EXPERIMENTS:
 */

// List experiments in project
$optimizely->project($projectId)->experiments();

// Create an experiment
$optimizely->project($projectId)->createExperiment(
    'Google',
    'google.com',
    ['status' => 'Paused']
);

// Update an experiment
$optimizely->experiment($experimentId)->update(['edit_url' => 'newsite.com']);

// Launch an experiment
$optimizely->experiment($experimentId)->launch();

// Pause an experiment
$optimizely->experiment($experimentId)->pause();

// Resume an experiment
$optimizely->experiment($experimentId)->resume();

// Archive an experiment
$optimizely->experiment($experimentId)->archive();