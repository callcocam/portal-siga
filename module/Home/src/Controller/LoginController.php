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
    }

    public function authenticateAction()
    {
        if($this->IdentityManager->hasIdentity()):
            $this->Messages()->flasshInfo("VOCÊ JÁ ESTA LOGADO");
        endif;

        $viewModel=new ViewModel();
        $request = $this->params()->fromPost();
        $this->form = $this->getForm();
        if ($request) {
            $this->form->setData($request);
            if ($this->form->isValid()) {
                $dataform = $this->form->getData();
                $result = $this->getIdentityManager()->login(
                    $dataform['email'],
                    $this->encryptPassword($dataform['email'],$dataform['password']),
                    $this->getRequest()->getServer('HTTP_USER_AGENT'),
                    $this->getRequest()->getServer('REMOTE_ADDR'));
                if ($result->isValid()) {
                    //authentication success
                    $this->Messages()->flashSuccess("LOGIN REALIZADO COM SUCESSO!");
                    return $this->redirect()->toRoute('users');
                } else {
                    $this->Messages()->error("LOGIN OU SENHA INVALIDOS!");
                    $viewModel->setVariable('error', 'Login Error');
                }
            }
        }
        $viewModel->setVariable('form',$this->form);
        return $viewModel;

    }

    public function logoutAction()
    {
        if ($this->getIdentityManager()->hasIdentity()) {
            $this->getIdentityManager()->logout();
        }
        return $this->redirect()->toRoute('authenticate');
    }
}