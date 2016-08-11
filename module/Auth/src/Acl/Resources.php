<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:07
 */

namespace Auth\Acl;


use Base\Model\AbstractRepository;
use Zend\Debug\Debug;
use Zend\Permissions\Acl\Resource\ResourceInterface;

class Resources implements ResourceInterface{

    protected $resources=[];

    /**
     * @param AbstractRepository $repository
     */
    public function __construct(AbstractRepository $repository){
        $Resources=$repository->findBy(['state'=>'0']);
        if($Resources->getResult()){
           foreach($Resources->getData() as $o){
              $this->resources[$o->getId()]=$o->getAlias();
           }
        }
    }
    /**
     * Returns the string identifier of the Resource
     *
     * @return string
     */
    public function getResourceId()
    {
        return $this->resources;
    }


}