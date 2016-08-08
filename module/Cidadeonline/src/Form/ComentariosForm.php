<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ComentariosForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Cidadeonline\Form\ComentariosForm
     */
    public function __construct(ContainerInterface $container, $name = 'Comentarios', array $options = array())
    {
        // Configurações iniciais do Form
        $this->container = $container;
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setAccess([]);
        $this->setCreated([]);
        $this->setEmpresa([]);
        $this->setModified(["type" => "hidden"]);
        $this->setSave([]);
        $this->setCsrf([]);
        $this->setState([]);
        $this->setDescription([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);
        $this->setAttributes(["action" => "comentarios", "class" => "form-geral Comments-form form-horizontal"]);
        //############################################ informações da coluna tipo ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'tipo',
                'options' => [
                    'label' => 'FILD_TIPO_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'tipo',
                    'class' =>'form-control',
                    'title' => 'FILD_TIPO_DESC',
                    'placeholder' => 'FILD_TIPO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna parent ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'parent',
                'options' => [
                    'label' => 'FILD_PARENT_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'parent',
                    'class' =>'form-control',
                    'title' => 'FILD_PARENT_DESC',
                    'placeholder' => 'FILD_PARENT_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna parent_id ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'parent_id',
                'options' => [
                    'label' => 'FILD_PARENT_ID_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'parent_id',
                    'class' =>'form-control',
                    'title' => 'FILD_PARENT_ID_DESC',
                    'placeholder' => 'FILD_PARENT_ID_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'title',
                'options' => [
                    'label' => 'FILD_TITLE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'title',
                    'class' =>'form-control',
                    'title' => 'FILD_TITLE_DESC',
                    'placeholder' => 'FILD_TITLE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
                    //'requerid' => true/false,
                ],
            ]
        );

        //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
                'name' => 'nota',
                'options' => [
                    'label' => 'FILD_NOTA_LABEL',
                    'value_options'      =>['1'=>"MUITO RUIM","2"=>"BOM",'3'=>"MÉDIO","4"=>"MUITO BOM",'5'=>"ÓTIMO"],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'nota',
                    'class' =>'form-control',
                    'title' => 'FILD_NOTA_DESC',
                    'placeholder' => 'FILD_NOTA_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'value'=>'5'
                ],
            ]
        );


        //############################################ informações da coluna created_by ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'created_by',
                'options' => [
                    'label' => 'FILD_CREATED_BY_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'created_by',
                    'class' =>'form-control',
                    'title' => 'FILD_CREATED_BY_DESC',
                    'placeholder' => 'FILD_CREATED_BY_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
                    //'requerid' => true/false,
                ],
            ]
        );
    }


}

