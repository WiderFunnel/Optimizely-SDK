<?php

use GrowthOptimized\Items\UploadedList;

/**
 * UPLOADED LISTS (TARGETING LISTS):
 */

// List uploaded lists in project
$optimizely->project($projectId)->uploadedLists();

// Find a uploaded list
$optimizely->uploadedLists()->find($uploadedListId);

// Create an uploaded list
$optimizely->project($projectId)->createUploadedList(
    'List', UploadedList::TYPE_QUERY_STRING, 'csv',
    'user_id', 'uid1,uid2,uid3,uid4'
);

// Update an uploaded list
$optimizely->uploadedList($uploadedListId)->update([
    'key_fields' => 'user_uid'
]);

// Delete an uploaded list
$optimizely->uploadedList($uploadedListId)->delete();