<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:30
 */

namespace Auth\Acl;

use Auth\Storage\IdentityManager;
use Zend\Permissions\Acl\Acl as AclDb;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Acl extends AclDb{

    protected $role_defaul='5';
    protected $identityManager;
    protected $resources;
    protected $roles;
    protected $actionsDefault=['useronline'];
    protected $privilesActions=[
        'delete'=>['index','create','update','delete','user-online'],
        'create'=>['create','update','index','user-online'],
        'update'=>['update','index','user-online'],
        'index'=>['index','user-online'],
    ];
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
         $this->roles=$roles->getRoleId();
        krsort($this->roles);
        //Adidiona as roles
        foreach ($this->roles as $role) {
             //Verifica a role ja foi add
            if (!$this->hasRole((string) $role->getId())) {
                //Inicia os parents da role ex:1 e parent da 2 a 2 da 3 etc
                //a 1 herda da 2,3,4 e 5
               $parentNames = array();
                if (!is_null($role->getParentId()) && (int) $role->getParentId()) {
                    $parentNames = (string) $role->getParentId();
                }
                //Adiciana a role
                $this->addRole(new Role((string) $role->getId()), $parentNames);
            }
            //Se a role for index conceda todos os privileges
            if ($role->getIsAdmin()) {
              $this->allow((string) $role->getId(), array(), array());
            }
        }
        return $this;

    }

    private function __setResources(Resources $resources)
    {

        if($resources->getResourceId()){
            $this->resources=$resources->getResourceId();
            foreach ($resources->getResourceId() as $key => $resource) {
                if (!$this->hasResource($resource)) {
                    $this->addResource(new Resource($resource));
                }
            }
        }


    }
    private function _setPrivileges(Privileges $privileges)
    {
        $list=$privileges->getPrivileges();
        if($list){
            foreach ($list as $key=> $privilege) {
                    if(isset($this->privilesActions[$privilege['title']])){
                        $allow=$this->privilesActions[$privilege['title']];
                    }
                    else
                    {
                         $allow=$privilege['title'];
                    }
                   $this->allow((string) $privilege['role_id'], $this->resources[$privilege["resource_id"]], $allow);

          }
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