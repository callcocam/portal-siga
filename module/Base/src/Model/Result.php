<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 10:28
 */

namespace Base\Model;


use Zend\Hydrator\ClassMethods;

class Result {

    protected $result=false;
    protected $error;
    protected $last_insert;
    protected $class;
    protected $data;
    protected $table;

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

    /**
     * @return mixed
     */
    public function getLastInsert()
    {
        return $this->last_insert;
    }

    /**
     * @param mixed $last_insert
     */
    public function setLastInsert($last_insert)
    {
        $this->last_insert = $last_insert;
    }

    /**
     * @return boolean
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param boolean $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }



    public function toArray()
    {
        $hydrator=new ClassMethods();
        return $hydrator->extract($this);
    }


} 