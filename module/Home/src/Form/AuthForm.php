<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 11:33
 */

namespace Home\Form;
use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;


class AuthForm extends AbstractForm {

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->setSave([]);
        $this->setCsrf([]);
        parent::__construct($container,'Auth');
        $this->setAttributes(['action'=>'login','class'=>'form-horizontal']);

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

        $this->add([
            'type'=>'password',
            'name'=>'password',
            'options'=>[
                'label'=>'Password'
            ],
            'attributes'=>[
                'id'=>'password',
                'class'=>'form-control',
                'placeholder'=>'Senha De Usuario'

            ]
        ]);

        $this->add([
            'name' => 'rememberme',
            'type' => 'hidden',
            'attributes'=>[
                'id'=>'rememberme',

            ]
        ]);

    }
}