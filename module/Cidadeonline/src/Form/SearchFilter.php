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
class SearchFilter extends AbstractInputFilter
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @return \Cidadeonline\Form\SearchFilter
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
      
        $inputFilter = parent::getInputFilter();
                    //############################################ informações da coluna catid ##############################################:
                     $inputFilter->add([
                    'name' => 'search',
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
               
        return $inputFilter;
    }


}

