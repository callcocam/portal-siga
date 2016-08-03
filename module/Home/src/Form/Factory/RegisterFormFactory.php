<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 15:33
 */

namespace Home\Form\Factory;


use Home\Form\RegisterForm;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Factory\FactoryInterface;

class RegisterFormFactory implements FactoryInterface {

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
       return new RegisterForm($container);
    }
}