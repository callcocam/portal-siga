<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:27
 */

namespace Auth\Controller;


use Auth\Form\PrivilegesFilter;
use Auth\Form\PrivilegesForm;
use Auth\Model\Privileges\Privileges;
use Auth\Model\Privileges\PrivilegesRepository;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class PrivilegesController extends AbstractController {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=PrivilegesRepository::class;
        $this->model=Privileges::class;
        $this->form=PrivilegesForm::class;
        $this->filter=PrivilegesFilter::class;
        $this->controller="privileges";
        $this->route="privileges";
       }
}