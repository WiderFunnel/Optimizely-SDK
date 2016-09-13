<?php

namespace Optimizely\Items;

/**
 * Class UploadedList
 * @package Optimizely\Items;
 */
class UploadedList extends ItemAbstract
{
    const TYPE_COOKIE = 0;
    const TYPE_QUERY_STRING = 1;
    const TYPE_ZIP_CODE = 2;
}