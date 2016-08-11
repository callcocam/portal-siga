<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 09/08/2016
 * Time: 23:54
 */

namespace Home\Form\Factory;


use Home\Form\ProfileForm;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ProfileFormFactory implements FactoryInterface{

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
       return new ProfileForm($container,"Profile");
    }
}