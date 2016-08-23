<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 10:29
 */

namespace Facebook;


use Facebook\Storage\Authentication;
use Facebook\Storage\Authorization;
use Facebook\Storage\Facebook;
use Facebook\Storage\Factory\AuthenticationFactory;
use Facebook\Storage\Factory\AuthorizationFactory;
use Facebook\Storage\Factory\FacebookFactory;
use Facebook\Storage\Factory\FbStorageFactory;
use Facebook\Storage\FbStorage;
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
                Facebook::class=>FacebookFactory::class,
                Authorization::class=>AuthorizationFactory::class,
                Authentication::class=>AuthenticationFactory::class,
                FbStorage::class=>FbStorageFactory::class
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
            'invokables' => [
                'OpenGraph' => 'Facebook\View\Helper\OpenGraph',
                //Override
                'headmeta' => 'Facebook\View\Helper\HeadMeta',
           ]
        ];
    }
}