<?php

namespace Optimizely\Collections;

use Illuminate\Support\Collection;

/**
 * Class CollectionAbstract
 * @package Optimizely\Collections
 */
abstract class CollectionAbstract extends Collection
{
    public abstract static function createFromJson($json);
}