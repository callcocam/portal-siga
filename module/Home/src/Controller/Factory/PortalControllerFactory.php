<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 04/08/2016
 * Time: 17:09
 */

namespace Home\Controller\Factory;


use Home\Controller\PortalController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PortalControllerFactory implements FactoryInterface {

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
       return new PortalController($container);
    }
}