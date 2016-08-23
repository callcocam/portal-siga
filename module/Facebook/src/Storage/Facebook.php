<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 10:25
 */

namespace Facebook\Storage;

use Facebook\Facebook as Face;
class Facebook extends Face {
    /**
     * @param array $config
     * @throws \Facebook\Exceptions\FacebookSDKException
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

    }
} 