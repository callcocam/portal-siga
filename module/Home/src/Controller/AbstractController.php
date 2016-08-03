<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:11
 */

namespace Home\Controller;


use Auth\Storage\IdentityManager;
use Interop\Container\ContainerInterface;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;

abstract class AbstractController extends AbstractActionController{

    protected $IdentityManager;
    protected $container;
    protected $table;
    protected $model;
    protected $form;
    protected $filter;
    protected $route;
    protected $controller;
    protected $action;
    protected $config;
    protected $user;
    protected $data;

    abstract function __construct(ContainerInterface $container);

    public function onDispatch(MvcEvent $e)
    {

        $this->config=$this->container->get('ZfConfig');
        $this->getIdentityManager();
        return parent::onDispatch($e);
    }


    /**
     * @return mixed
     */
    public function getIdentityManager()
    {
        $this->IdentityManager=$this->container->get(IdentityManager::class);
        return $this->IdentityManager;
    }




    /**
     * @return mixed
     */
    public function getData()
    {
        if($this->params()->fromPost()):
            $this->data=array_merge_recursive($this->params()->fromPost(),$this->params()->fromFiles());
            if(!empty($param)){
                return $this->data[$param];
            }
        endif;
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getForm($form="")
    {
        if(empty($form)):
            $this->form=$this->container->get($this->form);
        else:
            $this->form=$this->container->get($form);
        endif;
        return $this->form;
    }



    /**
     * @return mixed
     */
    public function getFilter($filter="")
    {
        if(empty($filter)):
            $this->filter=$this->container->get($this->filter);
        else:
            $this->filter=$this->container->get($filter);
        endif;
        return $this->filter;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->container->get($this->model);
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->container->get($this->table);
    }

    public function encryptPassword($login, $password) {
        return base64_encode(Pbkdf2::calc('sha256', $password, $login, 10000, strlen($this->config->staticsalt * 2)));
    }

    public function prepareData($data) {
        if (!empty($data['password'])):
            $this->data['password'] = $this->encryptPassword($data['email'], $data['password']);
            $this->data['usr_password_confirm'] = $this->encryptPassword($data['email'], $data['usr_password_confirm']);
            $this->data['usr_registration_token'] = md5(uniqid(mt_rand(), true));
        endif;
        return $this->data;
    }

    public function imprimirboletoAction()
    {

    }



}