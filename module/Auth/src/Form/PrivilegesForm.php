<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:14
 */

namespace Auth\Form;


use Auth\Model\Resources\ResourcesRepository;
use Auth\Model\Roles\RolesRepository;
use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;


class PrivilegesForm extends AbstractForm {
    public function __construct(ContainerInterface $container, $name, $options = [])
    {
        $this->container=$container;
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setAccess([]);
        $this->setCreated([]);
        $this->setEmpresa([]);
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
            'type'=>'select',
            'name'=>'role_id',
            'options'=>[
                'label'=>'Role',
                'value_options'=>$this->setValueOption(RolesRepository::class)
            ],
            'attributes'=>[
                'id'=>'phone',
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'select',
            'name'=>'resource_id',
            'options'=>[
                'label'=>'Resources',
                'value_options'=>$this->setValueOption(ResourcesRepository::class)
            ],
            'attributes'=>[
                'id'=>'phone',
                'class'=>'form-control',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);


    }


} 