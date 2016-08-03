<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 09:06
 */

namespace Base\Model;


use Zend\Hydrator\ClassMethods;

class AbstractModel {


    protected $id;
    protected $codigo;
    protected $asset_id;
    protected $empresa;
    protected $description;
    protected $state;
    protected $access;
    protected $created;
    protected $modified;

    /**
     * @return mixed
     */
    public function getAssetId()
    {
        return $this->asset_id;
    }

    /**
     * @param mixed $asset_id
     */
    public function setAssetId($asset_id)
    {
        $this->asset_id = $asset_id;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = date('Y-m-d', strtotime($created));
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified)
    {
        $this->modified =date('Y-m-d H:i:s', strtotime($modified));
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param mixed $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }

    public function exchangeArray($options = array()) {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($options, $this);
    }

    public function toArray()
    {
        $hydrator=new ClassMethods();
        return $hydrator->extract($this);
    }

}