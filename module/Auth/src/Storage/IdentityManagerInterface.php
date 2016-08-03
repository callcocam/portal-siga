<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 18:42
 */

namespace Auth\Storage;


interface IdentityManagerInterface {

    public function login($identity, $credential,$user_agent,$ip_address);
    public function logout();
    public function hasIdentity();
    public function storeIdentity($identity);
    public function getAuthService();

} 