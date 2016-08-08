<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:12
 */

namespace Home\Controller;

use Home\Form\AuthForm;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;


class LoginController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->form=AuthForm::class;
        $this->route='admin';
    }

    public function authenticateAction()
    {
        $this->template="/home/login/authenticate";
        return parent::authenticateAction();

    }

    public function logoutAction()
    {
       return parent::logoutAction();
    }
}