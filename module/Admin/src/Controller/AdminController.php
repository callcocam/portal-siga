<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 21:29
 */

namespace Admin\Controller;


use Base\Controller\AbstractController;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Base\Model\Cache;
class AdminController extends AbstractController  {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->template="admin/admin/index";
    }

    public function useronlineAction()
    {
    	$ViewModel=new ViewModel();
    	$ViewModel->setTemplate('admin/admin/tpl/admin/online-now');
    	$ViewModel->setTerminal(true);
    	return $ViewModel;
    }

}