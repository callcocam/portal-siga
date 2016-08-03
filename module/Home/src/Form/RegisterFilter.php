<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 11:37
 */

namespace Home\Form;



use Base\Form\AbstractInputFilter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\EmailAddress;
use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class RegisterFilter extends AbstractInputFilter {

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
           $clause=['id'=>$this->data['id']];
       endif;
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


       $inputFilter->add([
           'name' => 'password',
           'required' => true,
           'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
           ],
           'validators' => [
                   [
                       'name' => StringLength::class,
                       'options' => [
                           'encoding' => 'UTF-8',
                           'min' => 5,
                           'max' => 15,
                           'messages'=>[StringLength::TOO_LONG=>"Texto Muito Longo, Maximo:15",StringLength::TOO_SHORT=>"Texto Muito Curto, Minimo 5"]
                       ],
                   ],
               [
                   'name' => NotEmpty::class,
                   'options' => [
                       'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                   ],
               ],
           ],
       ]);

       $inputFilter->add([
           'name' => 'usr_password_confirm',
           'required' => false,
           'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
           ],
           'validators' => [
               [
                   'name'    => Identical::class,
                   'options' => [
                       'token' => 'password',
                       'messages'=>[
                             Identical::NOT_SAME=>"A Senha Não Corresponde Com A Confirmação"
                       ]
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
           'required' => false,
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
           'required' => false,
           'filters' => [
               ['name' => StripTags::class],
               ['name' => StringTrim::class],
           ]
       ]);

       $inputFilter->add([
           'name' => 'bairro',
           'required' => false,
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