<?php

use Dotenv\Dotenv;
use Optimizely\Optimizely;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

$token = getenv('OPTIMIZELY_TOKEN');

$projectId = 7395660087;
$experimentId = 7374240482;
$variationId = 7379901245;
$scheduleId = 7468850244;
$goalId = 7467950840;
$audienceId = 7468920495;
$uploadedListId = 7473160958;
$dimensionId = 7455900055;

$optimizely = Optimizely::create($token);

include __DIR__ . '/includes/projects.php';
include __DIR__ . '/includes/experiments.php';
include __DIR__ . '/includes/schedules.php';
include __DIR__ . '/includes/variations.php';
include __DIR__ . '/includes/goals.php';
include __DIR__ . '/includes/audiences.php';
include __DIR__ . '/includes/uploaded-lists.php';
include __DIR__ . '/includes/dimensions.php';
include __DIR__ . '/includes/results.php';