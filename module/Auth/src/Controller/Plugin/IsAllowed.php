<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Auth\Controller\Plugin;
use Auth\Acl\Roles;
use Exception;
use Zend\Debug\Debug;
use Zend\Form\Annotation\Type;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\MvcEvent;

/**
 * Description of IsAllowed
 *
 * @author Call
 */

class IsAllowed extends AbstractPlugin {
    
    protected $auth;
    protected $acl;


    public function __construct($auth,$acl) {
        $this->auth = $auth;
        $this->acl = $acl;
    }

    /**
     *
     * @param Type|MvcEvent $e
     * @throws Exception
     * @internal param Type $auth
     * @return type
     */
    public function __invoke(MvcEvent $e) {

        $controller = $e->getTarget();
        if (!$controller) {
            $controller = $e->getRouteMatch()->getParam('controller');
        }
        $controller_class = get_class($controller);
        $Resource = strtolower(str_replace("\\", "_", $controller_class));
        $privilege = $e->getRouteMatch()->getParam('action');

        if ($this->auth->hasIdentity()) {
            $user = $this->auth->hasIdentity();
            $role =(string)$user->role_id;
            //Debug::dump([$Resource,$role,$privilege]);
            if (!$this->acl->hasResource($Resource)) {
                return true;
               // throw new Exception('Resource ' . $Resource . ' not defined');
            }
            return $this->acl->isAllowed($role, $Resource, $privilege);
        } else {
           return $this->acl->isAllowed($this->acl->getRoleDefaul(), $Resource, $privilege);
        }
    }

}
