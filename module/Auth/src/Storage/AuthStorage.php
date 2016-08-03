<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:41
 */

namespace Auth\Storage;

use Zend\Authentication\Storage\Session as SessionStorage;
class AuthStorage extends SessionStorage {

    public function setRememberMe($rememberMe = 0, $time = 1209600) {
        if ($rememberMe == 1) {
            $this->session->getManager()->rememberMe($time);
        }
    }

    public function forgetMe() {
        $this->session->getManager()->forgetMe();
    }
    public function getSessionId()
    {
        return $this->session->getManager()->getId();
    }

} 