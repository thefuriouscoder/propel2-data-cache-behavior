<?php

namespace TFC\Propel\Behavior\DataCache;

use TFC\Propel\Behavior\DataCache\DataCacheBehaviorQueryBuilderModifier;

/**
 * Propel Data Cache Behavior
 *
 * @copyright Copyright (c) 2013 Domino Co. Ltd.
 * @license MIT
 * @package propel.generator.behavior
 */

/**
 * Propel Data Cache Behavior
 *
 * @copyright Copyright (c) 2013 Domino Co. Ltd.
 * @license MIT
 * @package propel.generator.behavior
 */
class DataCacheBehavior extends \Propel\Generator\Model\Behavior
{
    protected $parameters = array(
        "backend"    => "apc",
        "lifetime"   => 3600,
        "auto_cache" => true,
    );
    protected $objectBuilderModifier;
    protected $queryBuilderModifier;

    public function getQueryBuilderModifier()
    {
        if (is_null($this->queryBuilderModifier)) {
            $this->queryBuilderModifier = new DataCacheBehaviorQueryBuilderModifier($this);
        }
        return $this->queryBuilderModifier;
    }

    public function getObjectBuilderModifier()
    {
        if (is_null($this->objectBuilderModifier)) {
            $this->objectBuilderModifier = new DataCacheBehaviorObjectBuilderModifier($this);
        }
        return $this->objectBuilderModifier;
    }


}
