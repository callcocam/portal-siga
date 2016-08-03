<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 12:36
 */

namespace Auth\Form;


use Base\Form\AbstractInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
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
        $clause = null;
        if(isset($this->data['id']) && !empty($this->data['id']) && (int)$this->data['id']):
            $clause=['field'=>'id','value'=>$this->data['id']];
            $inputFilter->add($this->factory->createInput([
                'name' => 'email',
                'required' => true,
                'validators' => [
                    [
                        'name' => '\Zend\Validator\Db\NoRecordExists',
                        'options' => [
                            'table' => 'bs_users',
                            'field' => 'email',
                            'adapter' => $this->dbAdapter,
                            'exclude' => $clause,
                            'messages' =>[
                                \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Email Ja Existe!',
                                \Zend\Validator\Db\NoRecordExists::ERROR_NO_RECORD_FOUND => 'Email Ja Existe!',
                            ],
                        ],
                    ],
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
        else:
            $inputFilter->add($this->factory->createInput([
                'name' => 'email',
                'required' => true,
                'validators' => [
                    [
                        'name' => '\Zend\Validator\Db\NoRecordExists',
                        'options' => [
                            'table' => 'bs_users',
                            'field' => 'email',
                            'adapter' => $this->dbAdapter,
                            'exclude' => null,
                            'messages' =>[
                                \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Email Ja Existe!',
                                \Zend\Validator\Db\NoRecordExists::ERROR_NO_RECORD_FOUND => 'Email Ja Existe!',
                            ],
                        ],
                    ],
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
        endif;



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
            ]
        ]);


        $inputFilter->add([
            'name' => 'cep',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);

        $inputFilter->add([
            'name' => 'endereco',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ]);

        $inputFilter->add([
            'name' => 'bairro',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
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