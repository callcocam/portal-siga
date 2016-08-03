<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:28
 */

namespace Auth\Controller;


use Auth\Form\RolesFilter;
use Auth\Form\RolesForm;
use Auth\Model\Roles\Roles;
use Auth\Model\Roles\RolesRepository;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class RolesController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=RolesRepository::class;
        $this->model=Roles::class;
        $this->form=RolesForm::class;
        $this->filter=RolesFilter::class;
        $this->controller="roles";
        $this->route="roles";
    }
}