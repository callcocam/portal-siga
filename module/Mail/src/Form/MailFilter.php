<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Mail\Form;

use Base\Form\AbstractInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class MailFilter extends AbstractInputFilter
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @return \Mail\Form\MailFilter
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

        $this->setDescription([]);
        $inputFilter = parent::getInputFilter();
                    //############################################ informações da coluna catid ##############################################:
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

        $inputFilter->add($this->factory->createInput([
            'name' => 'email',
            'required' => true,
            'validators' => [
               [
                    'name'=>NotEmpty::class,
                    'options'=>[
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"],
                    ]
                ],
                [
                    'name'=>EmailAddress::class,
                    'options'=>[
                        'messages'=>[EmailAddress::INVALID_FORMAT=>"O Formato Do Email Não E valido"],
                    ]
                ]

            ],
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]

        ]));

         //############################################ informações da coluna subject ##############################################:
        $inputFilter->add([
            'name' => 'subject',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],

        ]);
               
        return $inputFilter;
    }


}

