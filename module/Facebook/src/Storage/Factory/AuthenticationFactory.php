<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 11:38
 */

namespace Facebook\Storage\Factory;


use Facebook\Storage\Authentication;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthenticationFactory implements  FactoryInterface {

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
        $fb=new Authentication($container);
        return $fb;
    }

}