<?php

namespace Base\Model;
use Zend\Cache\Storage\Plugin\PluginInterface;
use Zend\Cache\StorageFactory;

/**
 * Classe cache
 */
class Cache {

    protected $options;
    protected $cache;

    public function __construct($options = array()) {
        $this->setOptions($options);
        $this->cache = StorageFactory::factory($this->getOptions());

    }
    public function getCache()
    {
        return $this->cache;
    }

    public function setOptions($options) {
        $this->options = array(
            'adapter' => array(
                'name' => isset($options['name']) ? $options['name'] : 'filesystem',
                'options' => array(
                    'ttl' => isset($options['ttl']) ? $options['ttl'] : 600,
                    'dirLevel' => isset($options['dirLevel']) ? $options['dirLevel'] : 2,
                    'cacheDir' => isset($options['cacheDir']) ? $options['cacheDir'] : 'data/cache',
                    'dirPermission' => isset($options['dirPermission']) ? $options['dirPermission'] : 0755,
                    'filePermission' => isset($options['filePermission']) ? $options['filePermission'] : 0666,
                    'namespaceSeparator' => isset($options['namespaceSeparator']) ? $options['namespaceSeparator'] : '-db-'
                ),
            ),
            'plugins' => array('serializer'),
        );

        return $this;
    }

    public function getOptions() {
        return $this->options;
    }

    public function getItem($key, & $success = null, & $casToken = null) {
        return $this->cache->getItem($key, $success, $casToken); // TODO: Change the autogenerated stub
    }

    public function getItems(array $keys) {
        return $this->cache->getItems($keys); // TODO: Change the autogenerated stub
    }

    public function hasItem($key) {
        return $this->cache->hasItem($key); // TODO: Change the autogenerated stub
    }

    public function hasItems(array $keys) {
        return $this->cache->hasItems($keys); // TODO: Change the autogenerated stub
    }

    public function setItem($key, $value) {
        return $this->cache->setItem($key, $value); // TODO: Change the autogenerated stub
    }

    public function setItems(array $keyValuePairs) {
        return $this->cache->setItems($keyValuePairs); // TODO: Change the autogenerated stub
    }

    public function addItem($key, $value) {
        return $this->cache->addItem($key, $value); // TODO: Change the autogenerated stub
    }

    public function addItems(array $keyValuePairs) {
        return $this->cache->addItems($keyValuePairs); // TODO: Change the autogenerated stub
    }

    public function replaceItem($key, $value) {
        return $this->cache->replaceItem($key, $value); // TODO: Change the autogenerated stub
    }

    public function replaceItems(array $keyValuePairs) {
        return $this->cache->replaceItems($keyValuePairs); // TODO: Change the autogenerated stub
    }

    public function addPlugin(PluginInterface $plugin, $priority = 1) {
        return $this->cache->addPlugin($plugin, $priority); // TODO: Change the autogenerated stub
    }

    public function removePlugin(PluginInterface $plugin) {
        return $this->cache->removePlugin($plugin); // TODO: Change the autogenerated stub
    }

    public function removeItem($key) {
        return $this->cache->removeItem($key); // TODO: Change the autogenerated stub
    }

    public function removeItems(array $keys) {
        return $this->cache->removeItems($keys); // TODO: Change the autogenerated stub
    }

    public function incrementItem($key, $value) {
        return $this->cache->incrementItem($key, $value); // TODO: Change the autogenerated stub
    }

    public function incrementItems(array $keyValuePairs) {
        return $this->cache->incrementItems($keyValuePairs); // TODO: Change the autogenerated stub
    }

    public function decrementItem($key, $value) {
        return $this->cache->decrementItem($key, $value); // TODO: Change the autogenerated stub
    }

    public function decrementItems(array $keyValuePairs) {
        return $this->cache->decrementItems($keyValuePairs); // TODO: Change the autogenerated stub
    }

}
