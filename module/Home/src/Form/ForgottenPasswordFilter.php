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
use Zend\Validator\NotEmpty;

class ForgottenPasswordFilter extends AbstractInputFilter {


   public function getInputFilter()
   {
       $inputFilter= parent::getInputFilter();
       $clause = null;
       $inputFilter->add($this->factory->createInput([
               'name' => 'email',
               'required' => true,
               'validators' => [
                         [
                       'name' => '\Zend\Validator\Db\RecordExists',
                       'options' => [
                           'table' => 'bs_users',
                           'field' => 'email',
                           'adapter' => $this->dbAdapter,
                           'exclude' => $clause,
                           'messages' =>[
                               \Zend\Validator\Db\NoRecordExists::ERROR_RECORD_FOUND => 'Email Ja Existe!',
                               \Zend\Validator\Db\NoRecordExists::ERROR_NO_RECORD_FOUND=>"Email Não Encontrado"
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
                           'messages'=>[
                               EmailAddress::INVALID_FORMAT=>"O Formato Do Email Não E valido",
                           ]
                       ]
                   ]

               ],
               'filters' => [
                   ['name' => StripTags::class],
                   ['name' => StringTrim::class],
               ]

           ]));


       return $inputFilter;
   }


}