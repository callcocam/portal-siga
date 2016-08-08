<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Form;

use Auth\Model\Users\UsersRepository;
use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;
use Cidadeonline\Model\Categorias\CategoriasRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class PostsForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Cidadeonline\Form\PostsForm
     */
    public function __construct(ContainerInterface $container, $name = 'Posts', array $options = array())
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
        $this->setSavecopy([]);
        $this->setDescription([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);
        $this->setAttributes(["action" => "posts", "class" => "form-geral Manager form-horizontal"]);
        //############################################ informações da coluna catid ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
                'name' => 'catid',
                'options' => [
                    'label' => 'FILD_CATID_LABEL',
                    //'value_options'      =>[],
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


        //############################################ informações da coluna post_type ##############################################:
        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'post_type',
                'options' => [
                    'label' => 'FILD_POST_TYPE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'post_type',
                    //'class' =>'form-control',
                   // 'title' => 'FILD_POST_TYPE_DESC',
                   // 'placeholder' => 'FILD_POST_TYPE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'value'=>'post'
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna post_views ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'post_views',
                'options' => [
                    'label' => 'FILD_POST_VIEWS_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'post_views',
                    'class' =>'form-control',
                    'title' => 'FILD_POST_VIEWS_DESC',
                    'placeholder' => 'FILD_POST_VIEWS_PLACEHOLDER',
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


        //############################################ informações da coluna created_by ##############################################:
        $this->add([
                'type' => 'hidden',//text, select, radio, checkbox, textarea
                'name' => 'created_by',
                'options' => [
                    //'label' => 'FILD_CREATED_BY_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'created_by',
                    //'class' =>'form-control',
                    //'title' => 'FILD_CREATED_BY_DESC',
                    //'placeholder' => 'FILD_CREATED_BY_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]);
        if ($this->has('created_by')):
            if($this->get('created_by')->getAttribute('type')=="select"):
                $this->get('created_by')->setOptions(['value_options' =>$this->setValueOption(UsersRepository::class)]);
            else:
                $this->get('created_by')->setValue(isset($this->authservice->id)?$this->authservice->id:'1');
            endif;
        endif;
        if ($this->has('catid')):
            if($this->get('catid')->getAttribute('type')=="select"):
                $cat=$this->container->get(CategoriasRepository::class);
                $this->get('catid')->setOptions(['value_options' => $cat->getGategorias(['state'=>'0','parent_id' => ''])]);
            else:
                $this->get('catid')->setValue('null');
            endif;
        endif;
    }
}