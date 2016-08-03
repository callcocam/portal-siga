<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 15:33
 */

namespace Home\Form\Factory;


use Home\Form\ForgottenPasswordForm;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ForgottenPasswordFormFactory implements FactoryInterface {

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
       return new ForgottenPasswordForm($container);
    }
}