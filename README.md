# Optimizely PHP SDK
[![Packagist](https://img.shields.io/packagist/v/widerfunnel/Optimizely-SDK.svg?maxAge=2592000?style=flat-square)](https://packagist.org/packages/widerfunnel/optimizely-sdk)
[![Travis](https://img.shields.io/travis/WiderFunnel-Labs/Optimizely-SDK/master.svg?maxAge=2592000?style=flat-square)](https://travis-ci.org/WiderFunnel-Labs/Optimizely-SDK)

PHP Wrapper to interact with the Optimizely API.

## Installation

```bash
composer require widerfunnel/optimizely-sdk
```

## Usage

Simply create an Optimizely object, with a valid OAuth Token in the constructor: 

```php
$optimizely = Optimizely::create($token);
```

If you wish to use the token based authentication, simply pass `true` as a second argument: 

```php
$optimizely = Optimizely::create($token, true);
```

### Projects

```php
// Read a project
$optimizely->projects()->find($projectId);

// Create a project
$optimizely->projects()->create([
    'project_name' => 'My new project'
]);

// Update a project
$optimizely->projects()->update($projectId, [
    'project_name' => 'My new name'
]);

// Delete a project
// Not supported by Optimizely Rest API

// List projects in account
$optimizely->projects()->all();

// Activate a project
$optimizely->projects()->activate($projectId);

// Archive a project
$optimizely->projects()->archive($projectId);
```

### Experiments

```php
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
```

### Variations

```php
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
```

### Results

```php
// Fetch the results of an experiments
$optimizely->experiment($experimentId)->results();

// Fetch the results of an experiments (legacy version)
$optimizely->experiment($experimentId)->legacyResults();
```

### Schedules

```php
// Find a schedule
$optimizely->schedules()->find($scheduleId);

// Update schedule
$optimizely->schedule($scheduleId)->update(
    Carbon::now()->addDays(30),
    Carbon::now()->addDays(60)
);

// Update start time of a given schedule
$optimizely->schedule($scheduleId)->startAt(Carbon::now()->addDays(30));

// Update stop time of a given schedule
$optimizely->schedule($scheduleId)->stopAt(Carbon::now()->addDays(30));

// List schedules for an experiment
$optimizely->experiment($experimentId)->schedules();

// List active schedules for an experiment
$optimizely->experiment($experimentId)->schedules()->active();

// List inactive schedules for an experiment
$optimizely->experiment($experimentId)->schedules()->inactive();

// Create a schedule for an experiment
$optimizely->experiment($experimentId)->schedule(Carbon::now()->addDays(10));

// Start an experiment at a given time
$optimizely->experiment($experimentId)->startAt(Carbon::now()->addDays(10));

// Stop an experiment at a given time
$optimizely->experiment($experimentId)->stopAt(Carbon::now()->addDays(10));

// Delete a schedule
$optimizely->schedule($scheduleId)->delete();
```

### Audiences

```php
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
```

### Goals

```php
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
```

### Dimensions

```php
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
```

### Uploaded Lists

```php
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
```
