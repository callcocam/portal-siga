<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 22:58
 */

namespace Base\Services;



use Zend\Http\Client as ClienteHttp;


class Client extends ClienteHttp {


    public function __construct($uri = null, $options = null)
    {

        parent::__construct($uri, $options);
    }

} 