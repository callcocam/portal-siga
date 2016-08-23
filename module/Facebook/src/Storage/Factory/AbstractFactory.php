<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 12/08/2016
 * Time: 10:03
 */

namespace Facebook\Storage\Factory;


use Zend\Session\Container;

class AbstractFactory {

      const SESSION_KEY = 'access_token';
      protected $container;

    /**
     * Get Session Container
     *
     * @return \Zend\Session\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    public function setContainer()
    {
        $this->container=new Container('Facebook');
        return $this;
    }


    /**
     * Get Access Token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->getContainer()->offsetGet(self::SESSION_KEY);
    }

    /**
     * Set Access Token
     *
     * @param mixed $value
     * @return AbstractFactory
     */
    public function setAccessToken($value)
    {
        $this->getContainer()->offsetSet(self::SESSION_KEY, $value);

        return $this;
    }
} 