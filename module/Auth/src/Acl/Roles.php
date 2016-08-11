<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:13
 */

namespace Auth\Acl;


use Base\Model\AbstractRepository;
use Zend\Permissions\Acl\Role\RoleInterface;

class Roles implements RoleInterface{


    protected $roles;

    public function __construct(AbstractRepository $repository){
        $Roles=$repository->findBy(['state'=>'0']);
        if($Roles->getResult()){
            foreach($Roles->getData() as $o){
                $this->roles[$o->getId()]=$o;
            }
        }
    }
    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->roles;
    }

    /**
     * @return array
     */
    public function getParents()
    {
        return $this->parents;
    }

    /**
     * @return array
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }


}