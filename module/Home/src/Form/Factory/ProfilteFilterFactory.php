<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 09/08/2016
 * Time: 23:55
 */

namespace Home\Form\Factory;


use Home\Form\ProfileFilter;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProfilteFilterFactory implements FactoryInterface {

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
       return new ProfileFilter($container);
    }
}