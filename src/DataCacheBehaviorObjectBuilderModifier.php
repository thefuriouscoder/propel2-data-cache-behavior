<?php
/**
 * Propel Data Cache Behavior
 *
 * @copyright Copyright (c) 2013 Domino Co. Ltd.
 * @license MIT
 * @package propel.generator.behavior
 */

/**
 * Propel Data Cache Behavior Object Build Modifier
 *
 * @copyright Copyright (c) 2013 Domino Co. Ltd.
 * @license MIT
 * @package propel.generator.behavior
 */
namespace TFC\Propel\Behavior\DataCache;

class DataCacheBehaviorObjectBuilderModifier
{
    protected $behavior;
    protected $builder;
    protected $table;

    public function __construct($behavior)
    {
        $this->behavior = $behavior;
        $this->table    = $behavior->getTable();

    }

    public function postSave($builder)
    {
        $queryClassName = $builder->getStubQueryBuilder()->getClassname();

        return "{$queryClassName}::purgeCache();";
    }

    public function postDelete($builder)
    {
        return $this->postSave($builder);
    }
}
