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
class SearchForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Cidadeonline\Form\SearchForm
     */
    public function __construct(ContainerInterface $container, $name = 'Search', array $options = array())
    {
        // Configurações iniciais do Form
        $this->container = $container;
        $this->setCsrf([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);
          //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'search',
                'options' => [
                  //  'label' => 'FILD_TITLE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id'=>'search',
                    'class' =>'form-control',
                    'title' => 'FILD_TITLE_DESC',
                    'placeholder' => 'FILD_TITLE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'style'=>'width: 85%;'
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );

        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'first',
                'attributes' => [
                    'id'=>'first',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'value'=>'1'
                    ],
            ]
        );


        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'lasted',
                'attributes' => [
                    'id'=>'lasted',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'value'=>'8'
                ],
            ]
        );

        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'count',
                'attributes' => [
                    'id'=>'count',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'value'=>'8'
                ],
            ]
        );

    }


}

