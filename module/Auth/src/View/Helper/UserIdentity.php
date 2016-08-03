<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 14/07/2016
 * Time: 16:05
 */

namespace Auth\View\Helper;


use Auth\Acl\Acl;
use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;


class UserIdentity extends  AbstractHelper{
    protected $authAcl;
    protected $hasIdentity;
    public function getAuthAcl() {
        if ($this->authAcl) {
            return $this->authAcl;
        }
        else
            return false;
    }

    public function __construct(ContainerInterface $containerInterface) {
        $this->authAcl =$containerInterface->get(Acl::class);
        $this->hasIdentity=$this->authAcl->getIdentityManager()->hasIdentity();

    }

    /**
     * @return mixed
     */
    public function getHasIdentity()
    {
        return $this->hasIdentity;
    }

} 