<?php

/**
 * PROJECTS:
 */

//// Read a project
//$optimizely->projects()->find($projectId);
//
//// Create a project
//$optimizely->projects()->create([
//    'project_name' => 'My new project'
//]);
//
//// Update a project
//$optimizely->projects()->update($projectId, [
//    'project_name' => 'My new name'
//]);

// Delete a project
// Not supported by Optimizely Rest API

// List projects in account
dump($optimizely->projects()->all());
//
//// Activate a project
//$optimizely->projects()->activate($projectId);
//
//// Archive a project
//$optimizely->projects()->archive($projectId);