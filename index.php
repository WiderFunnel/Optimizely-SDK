<?php

require_once __DIR__.'/vendor/autoload.php';

$token = '488968c15ea3b129bcf040590434f48f:5158d927';

$projectId = '35583784';

$optimizely = new \Optimizely\Optimizely($token);

echo count($optimizely->project($projectId)->experiments());