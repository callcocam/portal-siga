<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:19
 */

namespace Auth\Model\Roles;


use Base\Model\AbstractRepository;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;

class RolesRepository extends AbstractRepository {

    /**
     * @param TableGateway $tableGateway
     */
    function __construct(TableGateway $tableGateway)
    {
        // TODO: Implement __construct() method.
        $this->tableGateway = $tableGateway;
    }

    public function getRoleId(){
        $roles=$this->findBy(['state'=>'0']);
        $valueOptions=[];
        if($roles->getData()->count())
        {
            foreach($roles->getData() as $role){
                $valueOptions[$role->getId()]=$role->getTitle();
            }

        }
        return $valueOptions;

    }
}