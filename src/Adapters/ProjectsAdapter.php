<?php

namespace WiderFunnel\Adapters;

use WiderFunnel\Collections\AudienceCollection;
use WiderFunnel\Collections\DimensionCollection;
use WiderFunnel\Collections\ExperimentCollection;
use WiderFunnel\Collections\GoalCollection;
use WiderFunnel\Collections\ProjectCollection;
use WiderFunnel\Collections\UploadedListCollection;
use WiderFunnel\Items\Audience;
use WiderFunnel\Items\Dimension;
use WiderFunnel\Items\Experiment;
use WiderFunnel\Items\Goal;
use WiderFunnel\Items\Project;
use WiderFunnel\Items\UploadedList;

/**
 * Class ProjectsAdapter
 * @package WiderFunnel
 */
class ProjectsAdapter extends AdapterAbstract
{
    /**
     * @return string
     */
    public function all()
    {
        $response = $this->client->get('projects');

        return ProjectCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return static
     */
    public function find($projectId = null)
    {
        $this->setResourceId($projectId);

        $response = $this->client->get("projects/{$this->getResourceId()}");

        return Project::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return ProjectsAdapter
     */
    public function activate()
    {
        return $this->update([
            'project_status' => Project::STATUS_ACTIVE
        ]);
    }

    /**
     * @param array $attributes
     * @return static
     */
    public function update(array $attributes)
    {
        $response = $this->client->put("projects/{$this->getResourceId()}", $attributes);

        return Project::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return ProjectsAdapter
     */
    public function archive()
    {
        return $this->update([
            'project_status' => Project::STATUS_ARCHIVED
        ]);
    }

    /**
     * @param $project_name
     * @param array $attributes
     * @return Project
     */
    public function create($project_name, array $attributes = [])
    {
        $attributes = array_merge($attributes, compact('project_name'));

        $response = $this->client->post('projects', $attributes);

        return Project::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $description
     * @param $edit_url
     * @param array $attributes
     * @return static
     */
    public function createExperiment($description, $edit_url, array $attributes = [])
    {
        $attributes = array_merge($attributes, compact('description', 'edit_url'));

        $response = $this->client->post("projects/{$this->getResourceId()}/experiments", $attributes);

        return Experiment::createFromJson($response->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function experiments()
    {
        $response = $this->client->get("projects/{$this->getResourceId()}/experiments");

        return ExperimentCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $name
     * @param string $description
     * @param array $attributes
     * @return static
     */
    public function createAudience($name, $description = '', array $attributes = [])
    {
        $attributes = array_merge($attributes, compact('name', 'description'));

        $response = $this->client->post("projects/{$this->getResourceId()}/audiences", $attributes);

        return Audience::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function audiences($projectId = null)
    {
        $this->setResourceId($projectId);

        $response = $this->client->get("projects/{$this->getResourceId()}/audiences");

        return AudienceCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $title
     * @param $goal_type
     * @param array $attributes
     * @return static
     */
    public function createGoal($title, $goal_type, array $attributes = [])
    {
        $attributes = array_merge($attributes, compact('title', 'goal_type'));

        $response = $this->client->post("projects/{$this->getResourceId()}/goals", $attributes);

        return Goal::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function goals($projectId = null)
    {
        $this->setResourceId($projectId);

        $response = $this->client->get("projects/{$this->getResourceId()}/goals");

        return GoalCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $name
     * @param string $description
     * @param string $client_api_name
     * @return static
     */
    public function createDimension($name, $description = '', $client_api_name = '')
    {
        $attributes = compact('name', 'description', 'client_api_name');

        $response = $this->client->post("projects/{$this->getResourceId()}/dimensions", $attributes);

        return Dimension::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function dimensions($projectId = null)
    {
        $this->setResourceId($projectId);

        $response = $this->client->get("projects/{$this->getResourceId()}/dimensions");

        return DimensionCollection::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $name
     * @param $type
     * @param $format
     * @param $key_fields
     * @param $list_content
     * @param array $attributes
     * @return static
     */
    public function createUploadedList($name, $type, $format, $key_fields, $list_content, array $attributes = [])
    {
        $attributes = array_merge($attributes, compact('name', 'type', 'format', 'key_fields', 'list_content'));

        $response = $this->client->post("projects/{$this->getResourceId()}/targeting_lists", $attributes);

        return UploadedList::createFromJson($response->getBody()->getContents());
    }

    /**
     * @param $projectId
     * @return mixed
     */
    public function uploadedLists($projectId = null)
    {
        $this->setResourceId($projectId);

        $response = $this->client->get("projects/{$this->getResourceId()}/targeting_lists");

        return UploadedListCollection::createFromJson($response->getBody()->getContents());
    }
}