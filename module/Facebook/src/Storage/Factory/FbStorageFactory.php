<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 21:18
 */

namespace Facebook\Storage\Factory;


use Facebook\Storage\Authentication;
use Facebook\Storage\FbStorage;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class FbStorageFactory implements FactoryInterface {

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
       return new FbStorage($container);
    }
}