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

class RegisterForm extends AbstractForm {

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->urlcaptcha = sprintf("%s/%s", $this->container->get('request')->getServer('DOCUMENT_ROOT'), 'images/captcha');
        $this->dirdata=sprintf("%s/%s", $this->container->get('request')->getServer('DOCUMENT_ROOT'), 'images/captcha/fonts/arial.ttf');
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setAccess(['type'=>'hidden']);
        $this->setCreated(['type'=>'hidden']);
        $this->setEmpresa([]);
        $this->setModified([]);
        $this->setSave([]);
        $this->setCsrf([]);
        $this->setState(['type'=>'hidden']);
        $this->setCaptcha([],$this->getCaptchaImage());
        $this->setDescription([]);
        parent::__construct($container,'Register');
        $this->setAttributes(['action'=>'auth-register','class'=>'form-horizontal']);



        $this->add([
            'type'=>'text',
            'name'=>'title',
            'options'=>[
                'label'=>'Nome Completo'
            ],
            'attributes'=>[
                'id'=>'title',
                'class'=>'form-control',
                'placeholder'=>'Nome Completo'
            ]
        ]);
        $this->add([
            'type'=>'hidden',
            'name'=>'cnpj',
              'attributes'=>[
                'id'=>'title',
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'text',
            'name'=>'phone',
            'options'=>[
                'label'=>'Telefone'
            ],
            'attributes'=>[
                'id'=>'phone',
                'class'=>'form-control',
                'placeholder'=>'(00)0000-0000'
            ]
        ]);


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
            'type'=>'password',
            'name'=>'usr_password_confirm',
            'options'=>[
                'label'=>'Check Password'
            ],
            'attributes'=>[
                'id'=>'usr_password_confirm',
                'class'=>'form-control',
                'placeholder'=>'Repita A Senha'

            ]
        ]);
         $this->add([
             'type'=>'hidden',
             'name'=>'usr_registration_token',
             'attributes'=>[
                 'id'=>'usr_registration_token',
                 'value'=>md5(date('YmdHis'))
             ]
         ]);


        $this->add([
            'type'=>'hidden',
            'name'=>'images',
            'attributes'=>[
                'id'=>'images',
                'value'=>'img/no_avatar.jpg'
            ]
        ]);

        $this->add([
            'type'=>'hidden',
            'name'=>'cidade',
            'attributes'=>[
                'id'=>'cidade',
                'value'=>"Não Cadastrado"
            ]
        ]);

        $this->add([
            'type'=>'hidden',
            'name'=>'endereco',
            'attributes'=>[
                'id'=>'endereco',
                'value'=>"Não Cadastrado"
            ]
        ]);

        $this->add([
            'type'=>'hidden',
            'name'=>'bairro',
            'attributes'=>[
                'id'=>'bairro',
                'value'=>"Não Cadastrado"
            ]
        ]);

        $this->add([
            'type'=>'hidden',
            'name'=>'cep',
            'attributes'=>[
                'id'=>'cep',
                'value'=>"Não Cadastrado"
            ]
        ]);


        $this->add([
            'type'=>'hidden',
            'name'=>'role_id',
            'attributes'=>[
                'id'=>'role_id',
                'value'=>'5'
            ]
        ]);



    }
}