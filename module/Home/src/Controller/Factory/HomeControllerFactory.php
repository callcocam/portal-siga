<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 01/08/2016
 * Time: 11:08
 */

namespace Home\Controller\Factory;


use Home\Controller\HomeController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class HomeControllerFactory implements FactoryInterface{

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
        return new HomeController($container);
    }
}