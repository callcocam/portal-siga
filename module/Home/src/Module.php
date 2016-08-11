<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:20
 */

namespace Home;



use Auth\Form\Factory\ProfileFilterFactory;
use Home\Form\AuthForm;
use Home\Form\Factory\AuthFormFactory;
use Home\Form\Factory\ForgottenPasswordFormFactory;
use Home\Form\Factory\ProfileFormFactory;
use Home\Form\Factory\RegisterFormFactory;
use Home\Form\ForgottenPasswordFilter;
use Home\Form\ForgottenPasswordForm;
use Home\Form\ProfileFilter;
use Home\Form\ProfileForm;
use Home\Form\RegisterFilter;
use Home\Form\RegisterForm;
use Home\View\Helper\HomeHelper;
use Interop\Container\ContainerInterface;
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
                RegisterForm::class=>RegisterFormFactory::class,
                ProfileForm::class=>ProfileFormFactory::class,
                ProfileFilter::class=>ProfileFilterFactory::class
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
        return [
            'factories'=>[
                'HomeHelper'=>function(ContainerInterface $container){
                    return new HomeHelper($container);
                }
            ],
            'invokables'=>[

            ]

        ];
    }
}