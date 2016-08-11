<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 12:36
 */

namespace Home\Form;


use Base\Form\AbstractInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;


class ProfileFilter extends AbstractInputFilter{



    function __construct(ContainerInterface $container)
    {

        $this->dbAdapter=$container->get(AdapterInterface::class);
    }


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
        $inputFilter= parent::getInputFilter();

        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
               [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);


        $inputFilter->add([
            'name' => 'url',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);

        $inputFilter->add([
            'name' => 'phone',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);

        $inputFilter->add([
            'name' => 'cnpj',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);

        $inputFilter->add([
            'name' => 'cidade',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'cep',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);
        $inputFilter->add([
            'name' => 'endereco',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'bairro',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'images',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);



        $inputFilter->add([
            'name' => 'usr_registration_token',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);

        $inputFilter->add([
            'name' => 'role_id',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);


        return $inputFilter;
    }


}