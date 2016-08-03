<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class BancosForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Admin\Form\BancosForm
     */
    public function __construct(ContainerInterface $container, $name = 'Bancos', array $options = array())
    {
        // Configurações iniciais do Form
        $this->container = $container;
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([
            'type' => 'text',//hidden, select, radio, checkbox, textarea
            'name' => 'codigo',
            'options' => [
                'label' => 'FILD_CODIGO_LABEL',
                //'value_options'      =>[],
                //"disable_inarray_validator" => true,
            ],
            'attributes' => [
                'id'=>'codigo',
                'class' =>'form-control',
                'title' => 'FILD_CODIGO_DESC',
                'placeholder' => 'FILD_CODIGO_PLACEHOLDER',
                'data-access' => '3',
                'data-position' => 'datas',
                //'readonly' => true/false,
                //'requerid' => true/false,
            ],
        ]);
        $this->setAccess([]);
        $this->setCreated([]);
        $this->setEmpresa([]);
        $this->setModified(["type" => "hidden"]);
        $this->setSave([]);
        $this->setCsrf([]);
        $this->setState(["type" => "hidden"]);
        $this->setDescription([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);
        $this->setAttributes(["action" => "bancos", "class" => "form-geral Manager form-horizontal"]);
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
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna agencia ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'agencia',
                'options' => [
                    'label' => 'FILD_AGENCIA_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'agencia',
                    'class' =>'form-control',
                    'title' => 'FILD_AGENCIA_DESC',
                    'placeholder' => 'FILD_AGENCIA_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna carteira ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'carteira',
                'options' => [
                    'label' => 'FILD_CARTEIRA_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'carteira',
                    'class' =>'form-control',
                    'title' => 'FILD_CARTEIRA_DESC',
                    'placeholder' => 'FILD_CARTEIRA_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna conta ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'conta',
                'options' => [
                    'label' => 'FILD_CONTA_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'conta',
                    'class' =>'form-control',
                    'title' => 'FILD_CONTA_DESC',
                    'placeholder' => 'FILD_CONTA_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna convenio ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'convenio',
                'options' => [
                    'label' => 'FILD_CONVENIO_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'convenio',
                    'class' =>'form-control',
                    'title' => 'FILD_CONVENIO_DESC',
                    'placeholder' => 'FILD_CONVENIO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna sequencial ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'sequencial',
                'options' => [
                    'label' => 'FILD_SEQUENCIAL_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'sequencial',
                    'class' =>'form-control',
                    'title' => 'FILD_SEQUENCIAL_DESC',
                    'placeholder' => 'FILD_SEQUENCIAL_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna conta_dv ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'conta_dv',
                'options' => [
                    'label' => 'FILD_CONTA_DV_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'conta_dv',
                    'class' =>'form-control',
                    'title' => 'FILD_CONTA_DV_DESC',
                    'placeholder' => 'FILD_CONTA_DV_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna agencia_dv ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'agencia_dv',
                'options' => [
                    'label' => 'FILD_AGENCIA_DV_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'agencia_dv',
                    'class' =>'form-control',
                    'title' => 'FILD_AGENCIA_DV_DESC',
                    'placeholder' => 'FILD_AGENCIA_DV_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna descricao_demonstrativo ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'descricao_demonstrativo',
                'options' => [
                    'label' => 'FILD_DESCRICAO_DEMONSTRATIVO_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'descricao_demonstrativo',
                    'class' =>'form-control',
                    'title' => 'FILD_DESCRICAO_DEMONSTRATIVO_DESC',
                    'placeholder' => 'FILD_DESCRICAO_DEMONSTRATIVO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna instrucoes ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'instrucoes',
                'options' => [
                    'label' => 'FILD_INSTRUCOES_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'instrucoes',
                    'class' =>'form-control',
                    'title' => 'FILD_INSTRUCOES_DESC',
                    'placeholder' => 'FILD_INSTRUCOES_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna images ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'images',
                'options' => [
                    'label' => 'FILD_IMAGES_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'images',
                    'class' =>'form-control',
                    'title' => 'FILD_IMAGES_DESC',
                    'placeholder' => 'FILD_IMAGES_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'images',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );
    }


}

