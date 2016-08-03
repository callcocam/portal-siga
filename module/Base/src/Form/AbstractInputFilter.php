<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 12:34
 */

namespace Base\Form;


use Interop\Container\ContainerInterface;

use Zend\Filter\ToInt;
use Zend\InputFilter\Factory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

use Zend\Validator\NotEmpty;
use Zend\Filter\StringTrim;//Não retirar esta endo usada sim
use Zend\Filter\StripTags;//Não retirar esta endo usada sim
use Zend\Validator\StringLength;

abstract class AbstractInputFilter  implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $factory;
    public $dbAdapter;
    public $data;

    protected $id;
    protected $codigo;
    protected $empresa;
    protected $assetid;
    protected $title;
    protected $description;
    protected $state;
    protected $ordering;
    protected $access;
    protected $createdby;
    protected $modifiedby;
    protected $alias;
    protected $created;
    protected $publishup;
    protected $publishdown;
    protected $modified;
    protected $captcha;
    protected $csrf;



    /**
     * Set input filter
     *
     * @param  InputFilterInterface $inputFilter
     * @return InputFilterAwareInterface
     */
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        // TODO: Implement setInputFilter() method.
    }

    /**
     * Retrieve input filter
     *
     * @return InputFilterInterface
     */
    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }
        $inputFilter = new InputFilter();
        $this->factory = new Factory();

         if(!is_null($this->captcha)){
             $inputFilter->add($this->captcha);
         }
        if(!is_null($this->id)) {
            $inputFilter->add($this->id);
        }
        if(!is_null($this->codigo)) {
            $inputFilter->add($this->codigo);
        }
        if(!is_null($this->empresa)) {
            $inputFilter->add($this->empresa);
        }
        if(!is_null($this->assetid)) {
            $inputFilter->add($this->assetid);
        }
        if(!is_null($this->createdby)) {
            $inputFilter->add($this->createdby);
        }
        if(!is_null($this->modifiedby)) {
            $inputFilter->add($this->modifiedby);
        }
        if(!is_null($this->alias)) {
            $inputFilter->add($this->alias);
        }
        if(!is_null($this->ordering)) {
            $inputFilter->add($this->ordering);
        }
        if(!is_null($this->access)) {
            $inputFilter->add($this->access);
        }
        if(!is_null($this->state)) {
            $inputFilter->add($this->state);
        }
        if(!is_null($this->created)) {
            $inputFilter->add($this->created);
        }
        if(!is_null($this->publishup)) {
            $inputFilter->add($this->publishup);
        }
        if(!is_null($this->publishdown)) {
            $inputFilter->add($this->publishdown);
        }
        if(!is_null($this->modified)) {
            $inputFilter->add($this->modified);
        }
        if(!is_null($this->description)) {
            $inputFilter->add($this->description);
        }

         if(!is_null($this->csrf)) {
             $inputFilter->add($this->csrf);
         }

        if(!is_null($this->title)) {
            $inputFilter->add($this->title);
        }
        $this->inputFilter = $inputFilter;
        return $this->inputFilter;

    }

    /**
     * @param mixed $access
     */
    public function setAccess($access)
    {
        $this->access =array_replace([
            'name' => 'access',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ],$access);
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = array_replace([
            'name' => 'alias',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$alias);
    }

    /**
     * @param mixed $assetid
     */
    public function setAssetid($assetid)
    {
        $this->assetid = array_replace([
            'name' => 'asset_id',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$assetid);
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title =  array_replace([
            'name' => 'title',
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
                        'max' => 250,
                        'messages'=>[StringLength::TOO_LONG=>"Texto Muito Longo, Maximo:255",StringLength::TOO_SHORT=>"Texto Muito Curto, Minimo 5"]
                    ],
                ],
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages'=>[NotEmpty::IS_EMPTY=>"Campo Obrigatorio"]
                    ],
                ],
            ],
        ],$title);
    }

    /**
     * @param mixed $csrf
     */
    public function setCsrf($csrf)
    {
        $this->csrf =  array_replace("",$csrf);
    }



    /**
     * @param mixed $captcha
     */
    public function setCaptcha($captcha)
    {
        $this->captcha = array_replace("",$captcha);
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = array_replace([
            'name' => 'codigo',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$codigo);
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = array_replace([
            'name' => 'created',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$created);
    }

    /**
     * @param mixed $createdby
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = array_replace([
            'name' => 'created_by',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ],$createdby);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = array_replace([
            'name' => 'dercription',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$description);
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = array_replace([
            'name' => 'empresa',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$empresa);
    }



    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = array_replace([
            'name' => 'id',
            'required' => false,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$id);
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified)
    {
        $this->modified = array_replace([
            'name' => 'modified',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$modified);
    }

    /**
     * @param mixed $modifiedby
     */
    public function setModifiedby($modifiedby)
    {
        $this->modifiedby = array_replace([
            'name' => 'modified_by',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ],$modifiedby);
    }

    /**
     * @param mixed $ordering
     */
    public function setOrdering($ordering)
    {
        $this->ordering = array_replace([
            'name' => 'ordering',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ],$ordering);
    }

    /**
     * @param mixed $publishdown
     */
    public function setPublishdown($publishdown)
    {
        $this->publishdown = array_replace([
            'name' => 'publish_down',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ],$publishdown);
    }

    /**
     * @param mixed $publishup
     */
    public function setPublishup($publishup)
    {
        $this->publishup =array_replace([
            'name' => 'publish_up',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ]
        ], $publishup);
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = array_replace([
            'name' => 'state',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ],$state);
    }


}
