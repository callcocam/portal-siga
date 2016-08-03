<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:14
 */

namespace Auth\Form;


use Auth\Model\Roles\RolesRepository;
use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;

class RolesForm extends AbstractForm {
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
        $this->setAttributes(['action'=>'roles','class'=>'form-geral Manager  form-horizontal form-label-left']);



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
            'name'=>'parent_id',
            'options'=>[
                'label'=>'Parent',
                'value_options'=>$this->setValueOption(RolesRepository::class)
            ],
            'attributes'=>[
                'id'=>'title',
                'class'=>'form-control',
                'placeholder'=>'Parent',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type'=>'text',
            'name'=>'is_admin',
            'options'=>[
                'label'=>'Usuario\Admin'
            ],
            'attributes'=>[
                'id'=>'title',
                'class'=>'form-control',
                'placeholder'=>'Usuario\Admin',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);


    }


} 