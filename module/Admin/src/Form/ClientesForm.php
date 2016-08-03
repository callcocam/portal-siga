<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:14
 */

namespace Admin\Form;


use Auth\Model\Roles\RolesRepository;
use Base\Form\AbstractForm;
use Base\Services\Client;
use Interop\Container\ContainerInterface;

class ClientesForm extends AbstractForm {
    public function __construct(ContainerInterface $container, $name, $options = [])
    {
        $this->container=$container;
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setAccess([]);
        $this->setCreated([]);
        $this->setEmpresa(['type'=>'select','options'=>['label'=>"Empresa"],'attributes'=>['class'=>'form-control']]);
        $this->setModified([]);
        $this->setSave([]);
        $this->setCsrf([]);
        $this->setState([]);
        $this->setDescription([]);
        parent::__construct($container,$name);
        $this->setAttributes(['action'=>'users','class'=>'form-geral Manager  form-horizontal form-label-left']);



        $this->add([
            'type'=>'text',
            'name'=>'title',
            'options'=>[
                'label'=>'Nome Completo'
            ],
            'attributes'=>[
                'id'=>'title',
                'class'=>'form-control',
                'placeholder'=>'Nome Completo',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'text',
            'name'=>'cnpj',
            'options'=>[
                'label'=>'FILD_CNPJ_LABEL'
            ],
            'attributes'=>[
                'id'=>'title',
                'class'=>'form-control',
                'placeholder'=>'FILD_CNPJ_PLACEHOLDER',
                'title'=>'FILD_CNPJ_DESC',
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
                'placeholder'=>'(00)0000-0000',
                'data-access' => '3',
                'data-position' => 'geral',
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
                'placeholder'=>'E-Mail Valido',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'hidden',
            'name'=>'password',
             'attributes'=>[
                'id'=>'password',
                'data-access' => '3',
                'data-position' => 'geral',
                 'value'=>md5('YmdHis')

            ]
        ]);

        $this->add([
            'type'=>'hidden',
            'name'=>'usr_registration_token',
            'attributes'=>[
                'id'=>'usr_registration_token',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);


        $this->add([
            'type'=>'hidden',
            'name'=>'images',
            'attributes'=>[
                'id'=>'images',
                'value'=>'img/no_avatar.jpg',
                'data-access' => '3',
                'data-position' => 'images',
            ]
        ]);

        $this->add([
            'type'=>'select',
            'name'=>'cidade',
            'options'=>[
                'label'=>'Selecione A Cidades'
            ],
            'attributes'=>[
                'id'=>'cidade',
                'value'=>"Não Cadastrado",
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'text',
            'name'=>'endereco',
            'options'=>[
                'label'=>'Endereço'
            ],
            'attributes'=>[
                'id'=>'endereco',
                'value'=>"Não Cadastrado",
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'text',
            'name'=>'bairro',
            'options'=>[
                'label'=>'Bairro'
            ],
            'attributes'=>[
                'id'=>'bairro',
                'value'=>"Não Cadastrado",
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'text',
            'name'=>'cep',
            'options'=>[
                'label'=>'Cep'
            ],
            'attributes'=>[
                'id'=>'cep',
                'value'=>"Não Cadastrado",
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'select',
            'name'=>'role_id',
            'options'=>[
                'label'=>'Selecione A Nivel'
            ],
            'attributes'=>[
                'id'=>'role_id',
                'value'=>"5",
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        if ($this->has('role_id')):
            if($this->get('role_id')->getAttribute('type')=="select"):
                $roles=$this->container->get(RolesRepository::class);
                $this->get('role_id')->setOptions(['value_options' => $roles->getRoleId()]);
            else:
                $this->get('role_id')->setValue('5');
            endif;
        endif;

        if ($this->has('cidade')):
            if($this->get('cidade')->getAttribute('type')=="select"):
                /**
                 * @var $client ClientHttp
                 */
                $client = $this->container->get(Client::class);

                $client->setUri(sprintf("%s/%s",$this->config->serverHost,'cidades'));
                $response = $client->send();

                if ($response->isSuccess()) {
                    $data=json_decode($response->getBody(),true);
                    $arraycidades=[];
                     foreach($data['data'] as $o){
                         $arraycidades[$o['id']]=$o['title'];
                     }

                }
                $this->get('cidade')->setOptions(['value_options' => $arraycidades]);
            else:
                $this->get('cidade')->setValue('1');
            endif;
        endif;



    }


} 