<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 04/08/2016
 * Time: 09:30
 */

namespace Home\Controller;


use Interop\Container\ContainerInterface;

class HomeController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
    }
}