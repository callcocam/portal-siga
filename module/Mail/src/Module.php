<?php

/**
 * Module
 */

namespace Mail;


use Mail\Form\Factory\MailFilterFactory;
use Mail\Form\Factory\MailFormFactory;
use Mail\Form\MailFilter;
use Mail\Form\MailForm;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ServiceProviderInterface{

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
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
            'factories'=>
                [
                    MailForm::class=>MailFormFactory::class,
                    MailFilter::class=>MailFilterFactory::class
                ]
        ];
    }
}
