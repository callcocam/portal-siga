<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 11:41
 */

namespace Facebook\Storage\Factory;

use Facebook\Storage\Authorization;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthorizationFactory extends AbstractFactory implements FactoryInterface {

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
       $auth= new Authorization($container);
        return $auth;
    }
}