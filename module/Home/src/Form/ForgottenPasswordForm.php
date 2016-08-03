<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 11:33
 */

namespace Home\Form;
use Base\Form\AbstractForm;
use Base\View\Helper\Form\Custom\Captcha\CustomCaptcha;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;

class ForgottenPasswordForm extends AbstractForm {

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->setSave([]);
        $this->setCsrf([]);
        parent::__construct($container,'ForgottenPassword');
        $this->setAttributes(['action'=>'forgotten-password','class'=>'form-horizontal']);
        $this->add([
            'type'=>'email',
            'name'=>'email',
            'options'=>[
                'label'=>'E-Mail'
            ],
            'attributes'=>[
                'id'=>'email',
                'class'=>'form-control',
                'placeholder'=>'E-Mail Valido'
            ]
        ]);



    }
}