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
class ClassificadosForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Cidadeonline\Form\ClassificadosForm
     */
    public function __construct(ContainerInterface $container, $name = 'Classificados', array $options = array())
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
        $this->setSavecopy([]);
        $this->setCsrf([]);
        $this->setState([]);
        $this->setDescription([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);
        $this->setAttributes(["action" => "classificados", "class" => "form-geral Manager form-horizontal"]);
        //############################################ informações da coluna catid ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
                'name' => 'catid',
                'options' => [
                    'label' => 'FILD_CATID_LABEL',
                    'value_options'      =>['quero-comprar'=>"QUERO COMPRAR",'quero-vender'=>"QUERO VENDER",'quero-trocar'=>"QUERO TROCAR",'quero-alugar'=>"QUERO ALUGAR"],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'catid',
                    'class' =>'form-control',
                    'title' => 'FILD_CATID_DESC',
                    'placeholder' => 'FILD_CATID_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
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
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna phone ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'phone',
                'options' => [
                    'label' => 'FILD_PHONE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'phone',
                    'class' =>'form-control',
                    'title' => 'FILD_PHONE_DESC',
                    'placeholder' => 'FILD_PHONE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna email ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'email',
                'options' => [
                    'label' => 'FILD_EMAIL_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'email',
                    'class' =>'form-control',
                    'title' => 'FILD_EMAIL_DESC',
                    'placeholder' => 'FILD_EMAIL_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna facebook ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'facebook',
                'options' => [
                    'label' => 'FILD_FACEBOOK_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'facebook',
                    'class' =>'form-control',
                    'title' => 'FILD_FACEBOOK_DESC',
                    'placeholder' => 'FILD_FACEBOOK_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna site ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'site',
                'options' => [
                    'label' => 'FILD_SITE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'site',
                    'class' =>'form-control',
                    'title' => 'FILD_SITE_DESC',
                    'placeholder' => 'FILD_SITE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna url ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'url',
                'options' => [
                    'label' => 'FILD_URL_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'url',
                    'class' =>'form-control',
                    'title' => 'FILD_URL_DESC',
                    'placeholder' => 'FILD_URL_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
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
                    'data-access' => '3',
                    'data-position' => 'images',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna classifcados_views ##############################################:
        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'classifcados_views',
                'options' => [
                    'label' => 'FILD_CLASSIFCADOS_VIEWS_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'classifcados_views',
                    'data-access' => '3',
                    'data-position' => 'images',

                ],
            ]
        );

        //############################################ informações da coluna classifcados_views ##############################################:
        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'created_by',
                'options' => [
                    //'label' => 'FILD_CLASSIFCADOS_VIEWS_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'created_by',
                    'data-access' => '3',
                    'data-position' => 'images',

                ],
            ]
        );
    }


}

