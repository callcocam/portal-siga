<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:07
 */

namespace Auth\Acl;


use Zend\Permissions\Acl\Resource\ResourceInterface;

class Resources implements ResourceInterface{

    protected $resources=[
        'admin','auth','nfe'
    ];
    /**
     * Returns the string identifier of the Resource
     *
     * @return string
     */
    public function getResourceId()
    {
        return $this->resources;
    }


}