<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 11:33
 */

namespace Auth\Form;
use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;
class UpdatePasswordForm extends AbstractForm {

    public function __construct(ContainerInterface $container, $name, $options = [])
    {
        $this->container=$container;
        $this->setId([]);
        $this->setSave([]);
        $this->setCsrf([]);
        parent::__construct($container,$name);
        $this->setAttributes(['action'=>'update-password','class'=>'form-geral Manager  form-horizontal form-label-left']);

        $this->add([
            'type'=>'password',
            'name'=>'password',
            'options'=>[
                'label'=>'Password'
            ],
            'attributes'=>[
                'id'=>'password',
                'class'=>'form-control',
                'placeholder'=>'Senha'
            ]
        ]);

        $this->add([
            'type'=>'password',
            'name'=>'usr_password_confirm',
            'options'=>[
                'label'=>'Check Password'
            ],
            'attributes'=>[
                'id'=>'usr_password_confirm',
                'class'=>'form-control',
                'placeholder'=>'Confirmar Senha'
            ]
        ]);




    }
}