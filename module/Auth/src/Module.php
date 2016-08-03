<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:54
 */

namespace Auth;


use Auth\Acl\Acl;
use Auth\Acl\Factory\AclFactory;
use Auth\Form\Factory\PrivilegesFilterFactory;
use Auth\Form\Factory\PrivilegesFormFactory;
use Auth\Form\Factory\ProfileFilterFactory;
use Auth\Form\Factory\ProfileFormFactory;
use Auth\Form\Factory\ResourcesFilterFactory;
use Auth\Form\Factory\ResourcesFormFactory;
use Auth\Form\Factory\RolesFilterFactory;
use Auth\Form\Factory\RolesFormFactory;
use Auth\Form\Factory\UpdatePasswordFilterFactory;
use Auth\Form\Factory\UpdatePasswordFormFactory;
use Auth\Form\Factory\UsersFilterFactory;
use Auth\Form\Factory\UsersFormFactory;
use Auth\Form\PrivilegesFilter;
use Auth\Form\PrivilegesForm;
use Auth\Form\ProfileFilter;
use Auth\Form\ProfileForm;
use Auth\Form\ResourcesFilter;
use Auth\Form\ResourcesForm;
use Auth\Form\RolesFilter;
use Auth\Form\RolesForm;
use Auth\Form\UpdatePasswordFilter;
use Auth\Form\UpdatePasswordForm;
use Auth\Form\UsersFilter;
use Auth\Form\UsersForm;
use Auth\Model\Privileges\Factory\PrivilegesFactory;
use Auth\Model\Privileges\Factory\PrivilegesRepositoryFactory;
use Auth\Model\Privileges\Privileges;
use Auth\Model\Privileges\PrivilegesRepository;
use Auth\Model\Resources\Factory\ResourcesFactory;
use Auth\Model\Resources\Factory\ResourcesRepositoryFactory;
use Auth\Model\Resources\Resources;
use Auth\Model\Resources\ResourcesRepository;
use Auth\Model\Roles\Factory\RolesFactory;
use Auth\Model\Roles\Factory\RolesRepositoryFactory;
use Auth\Model\Roles\Roles;
use Auth\Model\Roles\RolesRepository;
use Auth\Model\Users\Factory\UsersFactory;
use Auth\Model\Users\Factory\UsersRepositoryFactory;
use Auth\Model\Users\Users;
use Auth\Model\Users\UsersRepository;
use Auth\Storage\AuthStorage;
use Auth\Storage\Factory\AuthStorageFactory;
use Auth\Storage\Factory\IdentityManagerFactory;
use Auth\Storage\IdentityManager;
use Auth\View\Helper\UserIdentity;
use Interop\Container\ContainerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface,ViewHelperProviderInterface{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
       return [
        'factories'=>[
            Users::class=>UsersFactory::class,
            UsersRepository::class=>UsersRepositoryFactory::class,
            UsersFilter::class=>UsersFilterFactory::class,
            UsersForm::class=>UsersFormFactory::class,
            ProfileForm::class=>ProfileFormFactory::class,
            ProfileFilter::class=>ProfileFilterFactory::class,
            UpdatePasswordForm::class=>UpdatePasswordFormFactory::class,
            UpdatePasswordFilter::class=>UpdatePasswordFilterFactory::class,
            Resources::class=>ResourcesFactory::class,
            ResourcesRepository::class=>ResourcesRepositoryFactory::class,
            ResourcesForm::class=>ResourcesFormFactory::class,
            ResourcesFilter::class=>ResourcesFilterFactory::class,
            Roles::class=>RolesFactory::class,
            RolesRepository::class=>RolesRepositoryFactory::class,
            RolesForm::class=>RolesFormFactory::class,
            RolesFilter::class=>RolesFilterFactory::class,
            Privileges::class=>PrivilegesFactory::class,
            PrivilegesRepository::class=>PrivilegesRepositoryFactory::class,
            PrivilegesForm::class=>PrivilegesFormFactory::class,
            PrivilegesFilter::class=>PrivilegesFilterFactory::class,
            IdentityManager::class=>IdentityManagerFactory::class ,
            AuthStorage::class=>AuthStorageFactory::class,
            Acl::class=>AclFactory::class
        ]

       ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'invokables'=>[
            ],
            'factories'=>[
                'UserIdentity'=> function(ContainerInterface $container)
                {
                    return new UserIdentity($container);
                }
            ]
        ];
    }
}