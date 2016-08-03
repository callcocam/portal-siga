<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base\Controller;

use Auth\Storage\IdentityManager;
use Base\Files\FilesService;
use Interop\Container\ContainerInterface;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends AbstractActionController
{


    protected $IdentityManager;
    protected $container;
    protected $table;
    protected $model;
    protected $form;
    protected $filter;
    protected $route;
    protected $page='1';
    protected $controller;
    protected $action;
    protected $config;
    protected $user;
    protected $data;
    protected $template="admin/admin/listar";
    protected $filtro=[];
    protected $filesservice;

    abstract function __construct(ContainerInterface $container);

    public function onDispatch(MvcEvent $e)
    {
        $this->config=$this->container->get('ZfConfig');

        $this->getIdentityManager();
        if(!$this->IdentityManager->hasIdentity()){
            return $this->redirect()->toRoute('authenticate');
        }
        return parent::onDispatch($e);
    }

    /**
     * @return mixed
     */
    public function getIdentityManager()
    {
        $this->IdentityManager=$this->container->get(IdentityManager::class);
        $this->user=$this->IdentityManager->hasIdentity();
        return $this->IdentityManager;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $request=$this->getRequest();
        if(!$request->isPost()):
            return [];
        endif;
        $this->data=array_merge_recursive($request->getPost()->toArray(),
            $request->getFiles()->toArray());
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

    /**
     * @return mixed
     */
    public function getFilesservice()
    {
        $this->filesservice=$this->container->get(FilesService::class);
        return $this->filesservice;
    }

    public function encryptPassword($login, $password) {
        return base64_encode(Pbkdf2::calc('sha256', $password, $login, 10000, strlen($this->config->staticsalt * 2)));
    }

    public function indexAction()
    {
        $this->page=$this->params()->fromRoute('page','1');
        if($this->table):
            $this->filtro=$this->getData();
            $this->filtro['asset_id']=$this->controller;
            $this->data=$this->getTable()->select($this->filtro,$this->page);
            $this->data=$this->data->toArray();
        endif;

        $view=new ViewModel($this->data);
        $view->setVariable('controller',$this->controller);
        $view->setVariable('route',$this->route);
        $view->setVariable('page',$this->page);
        $view->setVariable('user',$this->user);
        $view->setVariable('filtro',$this->filtro);
        $view->setTemplate($this->template);
        return $view;
    }


    public function createAction()
    {
        $this->getForm();
        $this->page=$this->params()->fromRoute('page','1');
        $viewModel= new ViewModel(['form'=>$this->form]);
        $viewModel->setVariable('controller',$this->controller);
        $viewModel->setVariable('route',$this->route);
        $viewModel->setVariable('page',$this->page);
        $viewModel->setVariable('user',$this->user);
        $viewModel->setTemplate('/admin/admin/editar');
        return $viewModel;
    }
    public function editarAction()
    {
        $id=$this->params()->fromRoute('id');
        $this->page=$this->params()->fromRoute('page','1');
        if(!(int)$id){
            $this->Messages()->flashError("O Codigo Passado É Invalido!");
            return $this->redirect()->toRoute($this->route);
        }
        $this->getForm();
        $this->getTable()->find($id,false);
        if(!$this->getTable()->getData()->getResult()){
            $this->Messages()->flashError("O Codigo Passado É Invalido!");
            return $this->redirect()->toRoute($this->route);
        }
        $this->form->setData($this->getTable()->getData()->getData());
        $viewModel= new ViewModel(['form'=>$this->form]);
        $viewModel->setVariable('controller',$this->controller);
        $viewModel->setVariable('route',$this->route);
        $viewModel->setVariable('page',$this->page);
        $viewModel->setVariable('user',$this->user);
        $viewModel->setTemplate('/admin/admin/editar');
        return $viewModel;
    }

    public function deleteAction()
    {
        $id=$this->params()->fromRoute('id');
        if(!(int)$id){
            return new JsonModel(['result'=>false,'class'=>'danger','error'=>"O CODGO PASSADO É INALIDO"]);
        }
        $this->getTable()->find($id,false);
        if(!$this->getTable()->getData()->getResult()){
            return new JsonModel(['result'=>false,'class'=>'danger','error'=>"O CODGO PASSADO É INALIDO"]);
        }
        $this->getTable()->delete($id);
        return new JsonModel($this->getTable()->getData()->toArray());

    }

    public function finalizaAction()
    {
     if($this->getData()){
         $this->getForm();
         $model=$this->getModel();
         if ($this->params()->fromFiles('attachment') && is_array($this->params()->fromFiles('attachment'))):
             if (!$this->upload($this->params()->fromFiles('attachment'))):
                 return new JsonModel(array('result' => $this->filesservice->getResult(), 'id' => $this->data['id'],
                     'class' => 'danger',
                     'msg' => $this->filesservice->getMessages(), 'data' => $this->data));
             endif;
         endif;
         $inputfilter=$this->getFilter();
         $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
         $this->data['asset_id']=$this->controller;
         $inputfilter->data=$this->data;
         $this->form->setInputFilter($inputfilter->getInputFilter());
         $model->exchangeArray($this->data);
         $this->form->setData($this->data);
         if ($this->form->isValid()) {
             if (isset($this->data['save_copy'])):
                 $this->data['id'] = 'AUTOMATICO';
                 $model->setId(null);
             endif;
             //Se exitir o campo id valido e uma edição
             if (isset($this->data['id']) && (int) $this->data['id']):
                 $this->getTable()->update($model);
             else:
                 $this->getTable()->insert($model);
             endif;
             return new JsonModel($this->getTable()->getData()->toArray());
         }
         else{
             $error=[];
             foreach ($this->form->getMessages() as $key=> $messages){
                 foreach($messages as  $ms){
                     $error[$key]=sprintf("[%s-%s]",$key,$ms);
                 }
             }

         }
         return new JsonModel(['result'=>false,'class'=>'danger','error'=>implode(PHP_EOL,$error)]);
     }
        return new JsonModel(['result'=>false,'class'=>'danger','error'=>"NENHUM POST FOI PASSADO"]);

    }



    public function upload($file) {
        if ($file):
            $this->getFilesservice();
            $this->filesservice->persistFile($file, $this->data);
            if ($this->filesservice->getResult()):
                $this->data['images'] = $this->filesservice->getRealFolder();
                return TRUE;
            endif;
        endif;
        return false;
    }




}
