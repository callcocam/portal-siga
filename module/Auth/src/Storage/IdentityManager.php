<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:43
 */

namespace Auth\Storage;


use Zend\Authentication\AuthenticationService;

class IdentityManager implements IdentityManagerInterface{

    protected $authService;
    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }
    public function login($identity, $credential, $user_agent, $ip_address)
    {
        $this->getAuthService()->getAdapter()->setIdentity($identity)->setCredential($credential);
        $result = $this->getAuthService()->authenticate();
        if($result->isValid())
        {
            $user=$this->getAuthService()->getAdapter()->getResultRowObject();
            $user->ip_address = $ip_address;
            $user->user_agent = $user_agent;
            $this->storeIdentity($user);
        }
        return $result;
    }

    public function logout()
    {
        $this->getAuthService()->getStorage()->clear();
    }

    public function hasIdentity()
    {
        $sessionId = $this->getAuthService()->getStorage()->read();
        return $this->getAuthService()->getStorage()->read();
    }

    public function storeIdentity($identity)
    {
        $this->getAuthService()->getStorage()
            ->write($identity);
    }

    public function getAuthService()
    {
        return $this->authService;
    }
}
