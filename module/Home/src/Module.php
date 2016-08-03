<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:20
 */

namespace Home;



use Home\Form\AuthForm;
use Home\Form\Factory\AuthFormFactory;
use Home\Form\Factory\ForgottenPasswordFormFactory;
use Home\Form\Factory\RegisterFormFactory;
use Home\Form\ForgottenPasswordFilter;
use Home\Form\ForgottenPasswordForm;
use Home\Form\RegisterFilter;
use Home\Form\RegisterForm;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ConfigProviderInterface,ServiceProviderInterface,ViewHelperProviderInterface{

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
                AuthForm::class=>AuthFormFactory::class,
                ForgottenPasswordForm::class=>ForgottenPasswordFormFactory::class,
                RegisterForm::class=>RegisterFormFactory::class
            ],
            'invokables'=>[
                ForgottenPasswordFilter::class=>ForgottenPasswordFilter::class,
                RegisterFilter::class=>RegisterFilter::class

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
        // TODO: Implement getViewHelperConfig() method.
    }
}