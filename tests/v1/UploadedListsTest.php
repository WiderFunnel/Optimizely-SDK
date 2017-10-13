<?php

namespace WiderFunnel\Tests\v1;

use WiderFunnel\Tests\TestCase;
use WiderFunnel\Items\UploadedList;

/**
 * Class UploadedLists
 */
class UploadedLists extends TestCase
{
    /** @test */
    public function it_can_fetch_the_list_of_uploaded_lists_in_a_project()
    {
        $client = $this->fakeClient('uploaded-lists/uploaded-lists');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $uploadedLists = $optimizely->projects()->uploadedLists('1');

        $this->assertInstanceOf(\WiderFunnel\Collections\UploadedListCollection::class, $uploadedLists);
        $this->assertObjectHasAttribute('items', $uploadedLists);
        $this->assertInstanceOf(UploadedList::class, $uploadedLists->first());
        $this->assertObjectHasAttribute('id', $uploadedLists->first());
        $this->assertJsonStringEqualsJsonFile($this->getStub('uploaded-lists/uploaded-lists'), $uploadedLists->toJson());
    }

    /** @test */
    public function it_can_fetch_an_uploaded_list()
    {
        $client = $this->fakeClient('uploaded-lists/uploaded-list');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $uploadedList = $optimizely->uploadedLists()->find('1');

        $this->assertInstanceOf(UploadedList::class, $uploadedList);
        $this->assertJsonStringEqualsJsonFile($this->getStub('uploaded-lists/uploaded-list'), $uploadedList->toJson());
    }

    /** @test */
    public function it_can_create_an_uploaded_list_in_a_project()
    {
        $client = $this->fakeClient('uploaded-lists/uploaded-list');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $uploadedList = $optimizely->project('1')->createUploadedList(
            "Canadians", UploadedList::TYPE_ZIP_CODE, 'csv',
            'user_id', 'uid1,uid2'
        );

        $this->assertInstanceOf(UploadedList::class, $uploadedList);
        $this->assertJsonStringEqualsJsonFile($this->getStub('uploaded-lists/uploaded-list'), $uploadedList->toJson());
    }

    /** @test */
    public function it_can_update_an_uploaded_list()
    {
        $client = $this->fakeClient('uploaded-lists/uploaded-list');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $uploadedList = $optimizely->uploadedList('1')->update([
            'key_fields' => 'user_id'
        ]);

        $this->assertInstanceOf(UploadedList::class, $uploadedList);
        $this->assertJsonStringEqualsJsonFile($this->getStub('uploaded-lists/uploaded-list'), $uploadedList->toJson());
    }

    /** @test */
    public function it_can_delete_an_uploaded_list()
    {
        $client = $this->fakeClient('schedules/schedule');

        $optimizely = new \WiderFunnel\Optimizely($client);
        $uploadedList = $optimizely->uploadedList('1')->delete();

        $this->assertTrue($uploadedList);
    }
}