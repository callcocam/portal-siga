<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Form;

use Base\Form\AbstractInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\NotEmpty;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class CategoriasFilter extends AbstractInputFilter
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @return \Cidadeonline\Form\CategoriasFilter
     */
    public function __construct(ContainerInterface $container)
    {
        // Configurações iniciais do Form
        $this->dbAdapter=$container->get(AdapterInterface::class);
    }

    /**
     * construct do Filter
     *
     * @return InputFilter
     */
    public function getInputFilter()
    {
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setAccess([]);
        $this->setCreated([]);
        $this->setEmpresa([]);
        $this->setModified([]);
        $this->setState([]);
        $this->setDescription([]);
        $inputFilter = parent::getInputFilter();
                    //############################################ informações da coluna parent_id ##############################################:
                     $inputFilter->add([
                    'name' => 'parent_id',
                    'required' => false,
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],

                ]);
        
        
                    //############################################ informações da coluna title ##############################################:
                     $inputFilter->add([
                    'name' => 'title',
                    'required' => true,
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],
                    'validators' => [
                        [
                            'name' => NotEmpty::class,
                            'options' => [
                                'messages' => [NotEmpty::IS_EMPTY => "Campo Obrigatorio"]
                            ],
                        ],
                    ],
                ]);
        
        
                    //############################################ informações da coluna url ##############################################:
                     $inputFilter->add([
                    'name' => 'url',
                    'required' => false,
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],

                ]);
        
        
                    //############################################ informações da coluna images ##############################################:
                     $inputFilter->add([
                    'name' => 'images',
                    'required' => false,
                    'filters' => [
                        ['name' => StripTags::class],
                        ['name' => StringTrim::class],
                    ],

                ]);
        
        
        return $inputFilter;
    }


}

