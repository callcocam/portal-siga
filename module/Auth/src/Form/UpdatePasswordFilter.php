<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/07/2016
 * Time: 11:37
 */

namespace Auth\Form;



use Base\Form\AbstractInputFilter;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Validator\Identical;
use Zend\Validator\NotEmpty;
use Zend\Validator\StringLength;

class UpdatePasswordFilter extends AbstractInputFilter {


    function __construct(ContainerInterface $container)
    {

        $this->dbAdapter=$container->get(AdapterInterface::class);
    }



    public function getInputFilter()
   {
       $this->setId([]);
       $inputFilter= parent::getInputFilter();
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
           'required' => true,
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



       return $inputFilter;
   }


}