<?php

require_once __DIR__.'/vendor/autoload.php';

$token = '488968c15ea3b129bcf040590434f48f:5158d927';

$projectId = '7395660087';

$experimentId = '7374240482';

$startTime = '2016-12-01T08:00:00Z';

$endTime = '2017-02-14T08:30:00Z';

$scheduleId = '7352016724';

$optimizely = new \Optimizely\Optimizely($token);

//PROJECTS: 

// echo $optimizely->create('foo4');

// echo $optimizely->project($projectId)->update(['project_name' => '123foo', 'include_jquery' => true]);

// echo $optimizely->project($projectId)->activate();

// echo $optimizely->project($projectId)->archive();

//EXPERIMENTS: 

// echo $optimizely->project($projectId)->experiments();

// echo $optimizely->project($projectId)->create('FooExp321','foobars123.com', ['status' => 'Paused']);

// echo $optimizely->experiment($experimentId);

// echo $optimizely->experiment($experimentId)->update(['edit_url' => 'newsite.com']);

// echo $optimizely->experiment($experimentId)->launch();

// echo $optimizely->experiment($experimentId)->pause();

// echo $optimizely->experiment($experimentId)->archive();

// echo $optimizely->experiment($experimentId)->schedules();

// echo $optimizely->experiment($experimentId)->schedule($startTime,$endTime);

echo $optimizely->experiment($experimentId)->variations();

//SCHEDULES

// echo $optimizely->schedule($scheduleId)->update($startTime, $endTime);

// echo $optimizely->schedule($scheduleId)->delete();
