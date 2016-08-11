<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:14
 */

namespace Auth\Form;


use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;

class ResourcesForm extends AbstractForm {
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
        $this->setAttributes(['action'=>'resources','class'=>'form-geral Manager  form-horizontal form-label-left']);

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
            'name'=>'alias',
            'options'=>[
                'label'=>'Alias'
            ],
            'attributes'=>[
                'id'=>'alias',
                'class'=>'form-control',
                'placeholder'=>'Alias',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
        if ($this->has('alias')):
            if($this->get('alias')->getAttribute('type')=="select"):
                $controllers = $container->get('Config');
                foreach($controllers['controllers']['factories'] as $key=> $value){
                    $Resource[strtolower(str_replace("\\", "_", $key))]=$key;
                }
               $this->get('alias')->setOptions(['value_options' => $Resource]);
            else:
                $this->get('alias')->setValue('admin_controller_admincontroller');
            endif;
        endif;

    }


} 