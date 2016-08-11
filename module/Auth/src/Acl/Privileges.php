<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:36
 */

namespace Auth\Acl;


use Base\Model\AbstractRepository;

class Privileges {
 protected $privileges=[];
    public function __construct(AbstractRepository $repository){
        $Privileges=$repository->findBy(['state'=>'0']);
        if($Privileges->getResult()){
            foreach($Privileges->getData() as $o){
                $this->privileges[]=$o->toArray();
            }
        }
    }
    public function getPrivileges()
    {
        return $this->privileges;
    }
} 