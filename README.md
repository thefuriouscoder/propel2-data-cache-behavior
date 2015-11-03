Data Cache Behavior for Propel2
==========================
[![Build Status](https://travis-ci.org/SNakano/PropelDataCacheBehavior.png)](https://travis-ci.org/SNakano/PropelDataCacheBehavior)
[![Latest Stable Version](https://poser.pugx.org/thefuriouscoder/propel2-data-cache-behavior/v/stable.png)](https://packagist.org/packages/thefuriouscoder/propel2-data-cache-behavior)
[![Total Downloads](https://poser.pugx.org/thefuriouscoder/propel2-data-cache-behavior/downloads.png)](https://packagist.org/packages/snakano/propel-data-cache-behavior)

A Propel ORM behavior that provide auto data caching to your model. Based on Propel 1.6 work of [SNakano](https://github.com/SNakano/PropelDataCacheBehavior).

- support caching system APC, memcached and Redis (via [DominoCacheStore](https://github.com/SNakano/CacheStore))
- auto caching and auto flush.

#### What's the difference with Query Cache Behavior

[Query Cache Behavior](http://propelorm.org/behaviors/query-cache.html) is caching transformation of a query object (caching SQL code). This Behavior is caching the results of database. (caching result data)


Requirements
------------
- PHP >= 5.3
- Propel >= 2.0.0
- [DominoCacheStore](https://github.com/SNakano/CacheStore)


Install
-------

### Composer

Add a dependency on `thefuriouscoder/propel2-data-cache-behavior` to your project's `composer.json` file.

```javascript
{
    "require": {
        "thefuriouscoder/propel2-data-cache-behavior": "dev-master"
    }
}
```

Configuration
-------------

### schema.xml

```xml
<table name="book">
  <column name="id" required="true" primaryKey="true" autoIncrement="true" type="INTEGER" />
  <column name="title" type="VARCHAR" required="true" primaryString="true" />
  <behavior name="data_cache">
    <parameter name="backend" value="apc" />     <!-- cache system. "apc" or "memcache", default "apc". (optional) -->
    <parameter name="lifetime" value="3600" />   <!-- cache expire time (second). default 3600 (optional) -->
    <parameter name="auto_cache" value="true" /> <!-- auto cache enable. default true (optional) -->
  </behavior>
</table>
```

### Initialize the Cache Store.

Add the following configuration code to your project bootstraping file depending on the storage you are goinng to use.

### Using Memcached (php5-memcached extension needed)
```php
// configure memcached setting.
Domino\CacheStore\Factory::setOption(
    array(
        'storage'     => 'memcached',
        'prefix'      => 'rlyeh',
        'default_ttl' => 360,
        'servers'     => array(
            array('server1', 11211, 20),
            array('server2', 11211, 80)
        )
    )
);

```

### Using APC
```php
// configure APC setting.
Domino\CacheStore\Factory::setOption(
    array(
        'storage'     => 'apc',
        'default_ttl' => 360
    )
);

```


### Using Redis
```php
// configure Redis setting.
Domino\CacheStore\Factory::setOption(
    array(
        'storage'     => 'redis',
        'prefix'      => 'rlyeh',
        'host         => '127.0.0.1',
        'port'        => 6379,
        'default_ttl' => 360
    )
);

```

### Basic usage

```php
$title = 'Cthulhu Mythos';
BookQuery::create()
    ->filterByTitle($title)
    ->findOne(); // from Database

BookQuery::create()
    ->filterByTitle($title)
    ->findOne(); // from caching system
```

### Disable cache

```php
$title = 'Cthulhu Mythos';
BookQuery::create()
    ->setCacheDisable()  // disable cache
    ->filterByTitle($title)
    ->findOne();
```

- setCacheEnable()
- setCacheDisable()
- isCacheEnable()
- setLifetime($ttl)


### When cache delete?

```php
$book = new Book;
$book->setId(1);
$book->setTitle("Cthulhu Myhtos");
$book->save();  // purge cache.
```

- expire cache lifetime.
- call `save()` method.
- call `delete()` method.
- call `BookQuery::doDeleteAll()` method.
- call `BookQuery::purgeCache()` method.

### Manually delete cache.

```php
$title = 'Cthulhu Mythos';
$query = BookQuery::create();
$book  = $query->filterByTitle($title)->findOne();
$cacheKey = $query->getCacheKey(); // get cache key.

BookPeer::cacheDelete($cacheKey);  // delete cache by key.
```

License
-------

MIT License