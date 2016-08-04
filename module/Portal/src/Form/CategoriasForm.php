<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;
use Portal\Model\Categorias\CategoriasRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class CategoriasForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Portal\Form\CategoriasForm
     */
    public function __construct(ContainerInterface $container, $name = 'Categorias', array $options = array())
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
        $this->setAttributes(["action" => "categorias", "class" => "form-geral Manager form-horizontal"]);
        //############################################ informações da coluna parent_id ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
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
            ]);
        if ($this->has('parent_id')):
            if($this->get('parent_id')->getAttribute('type')=="select"):
                $cat=$this->container->get(CategoriasRepository::class);
                $this->get('parent_id')->setOptions(['value_options' => $cat->parentCat()]);
            else:
                $this->get('parent_id')->setValue('null');
            endif;
        endif;
    }
}