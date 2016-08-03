<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:30
 */

namespace Auth\Acl;

use Auth\Storage\IdentityManager;
use Zend\Debug\Debug;
use Zend\Permissions\Acl\Acl as AclDb;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl extends AclDb{

    protected $role_defaul='5';
    protected $identityManager;
    public function __construct(IdentityManager $identityManager,Roles $roles,Resources $resources,Privileges $privileges)
    {
        $this->identityManager=$identityManager;
        if($this->identityManager->hasIdentity()){
          $this->role_defaul=$this->identityManager->hasIdentity()->role_id;
        }
        $this->_setRoles($roles);
        $this->__setResources($resources);
        $this->_setPrivileges($privileges);
    }

    private function _setRoles(Roles $roles)
    {
        $is_admin=$roles->getIsAdmin();
        $parent=$roles->getParents();
        $rls=$roles->getRoleId();
        //Garante a ordens das roles
        krsort($rls);
        //Adidiona as roles
        foreach ($rls as $role => $value) {
            //Verifica a role ja foi add
            if (!$this->hasRole((string) $role)) {
                //Inicia os parents da role ex:1 e parent da 2 a 2 da 3 etc
                //a 1 herda da 2,3,4 e 5
               $parentNames = array();
                if (!is_null($parent[$role]) && (int) $parent[$role]) {
                    $parentNames = (string) $parent[$role];
                }
                //Adiciana a role
                $this->addRole(new Role((string) $role), $parentNames);
            }
            //Se a role for index conceda totos os privileges
            if ($is_admin[$role]) {
                $this->allow((string) $role, array(), array());
            }
        }
        return $this;

    }

    private function __setResources(Resources $resources)
    {
        foreach ($resources->getResourceId() as $key => $resource) {

            if (!$this->hasResource($resource)) {
                $this->addResource(new Resource($resource));
            }
        }

    }
    private function _setPrivileges(Privileges $privileges)
    {
        $list=$privileges->getPrivileges();
        krsort($list);
        foreach ($list as $key=> $privilege) {
           // Debug::dump($privilege);
            if($privilege['privilege']):
                $this->allow((string) $privilege['role'], $privilege['resource'], $privilege['privilege']);
            else:
                $this->deny((string) $privilege['role'], $privilege['resource'], $privilege['privilege']);
            endif;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getRoleDefaul()
    {
        return $this->role_defaul;
    }

    /**
     * @return mixed
     */
    public function getIdentityManager()
    {
        return $this->identityManager;
    }


}