<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:13
 */

namespace Auth\Acl;


use Zend\Permissions\Acl\Role\RoleInterface;

class Roles implements RoleInterface{

    protected $role=["1"=>"suport","2"=>"admin", "3"=>"member", "4"=>"guest","5"=>"visit"];
    protected $parents=['1'=>'2','2'=>'3','3'=>'4','4'=>'5','5'=>null];
    protected $is_admin=['1'=>true,'2'=>false,'3'=>false,'4'=>false,'5'=>false];
    /**
     * Returns the string identifier of the Role
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->role;
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