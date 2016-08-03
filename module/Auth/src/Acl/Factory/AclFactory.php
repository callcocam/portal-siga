<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 01:00
 */

namespace Auth\Acl\Factory;


use Auth\Acl\Acl;
use Auth\Acl\Privileges;
use Auth\Acl\Resources;
use Auth\Acl\Roles;
use Auth\Storage\IdentityManager;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AclFactory implements FactoryInterface{

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
        $roles=new Roles();
        $resources=new Resources();
        $privileges=new Privileges();
        return new Acl($container->get(IdentityManager::class),$roles,$resources,$privileges);
    }
}