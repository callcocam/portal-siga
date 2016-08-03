<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:28
 */

namespace Auth\Controller;


use Auth\Form\UsersFilter;
use Auth\Form\UsersForm;
use Auth\Model\Users\Users;

use Auth\Model\Users\UsersRepository;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;

class UsersController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=UsersRepository::class;
        $this->model=Users::class;
        $this->filter=UsersFilter::class;
        $this->form=UsersForm::class;
        $this->controller="users";
        $this->route="users";
    }
}