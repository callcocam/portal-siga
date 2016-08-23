<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:11
 */

namespace Home\Controller;


use Auth\Storage\IdentityManager;
use Base\Files\FilesService;
use Interop\Container\ContainerInterface;
use Mail\Service\Mail;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Debug\Debug;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Base\Model\Cache;

abstract class AbstractController extends AbstractActionController{

    protected $IdentityManager;
    protected $container;
    protected $table;
    protected $model;
    protected $form;
    protected $filter;
    protected $filesservice;
    protected $route;
    protected $controller;
    protected $action;
    protected $template='/home/portal/index';
    protected $config;
    protected $user;
    protected $data;
    protected $id;
    protected $search;
    protected $filtro=['search'=>'','first'=>'1','lasted'=>'8','count'=>'8'];
    protected $page;
    protected $registro_por_page;

    abstract function __construct(ContainerInterface $container);

    public function onDispatch(MvcEvent $e)
    {
        $this->id=$this->params()->fromRoute("id");
        $this->config=$this->container->get('ZfConfig');
        $this->getIdentityManager();
        $this->action=$this->params()->fromRoute('action','index');
        $this->search=[
        'id'=>$this->id,
        'parent'=>'post',
        'route'=>$this->route,
        'action'=>$this->action,
        'page'=>$this->params()->fromRoute("page",'1'),
        'user'=>$this->user,
        'filtro'=>$this->filtro,
        'config'=>$this->config
        ];
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

    /**
     * @return mixed
     */
    public function getFilesservice()
    {
        $this->filesservice=$this->container->get(FilesService::class);
        return $this->filesservice;
    }
    

    public function indexAction()
    {
        $ViewModel=new ViewModel();
        $ViewModel->setTemplate('/home/portal/index');
        return $ViewModel;
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
            if(isset($this->data['password'])){
                $this->data['usr_password_confirm'] =$this->data['password'];
                $this->prepareData($this->data);
            }
            $inputfilter=$this->getFilter();
            $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
            $this->data['asset_id']=$this->controller;
            $inputfilter->data=$this->data;
            $this->form->setInputFilter($inputfilter->getInputFilter());
            $model->exchangeArray($this->data);
            $this->form->setData($this->data);

            if ($this->form->isValid()) {
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


    /**
     * Envia um email de confirmação para o usuario
     * que se cadastrou no site
     * junto com um oken de confirmação
     * assunto ->Subject
     * dados do email ->Data
     * template de email ->Template
     * @param $data
     */
    public function sendConfirmationEmail($data) {
        if(!$data):
            return $this->redirect()->toRoute('authenticate');
        endif;
        $url = sprintf("%s%s", $this->getRequest()->getServer('HTTP_ORIGIN'), $this->url()->fromRoute('confirm-register', array(
            'action' => 'confirm-email', 'id' => $data['usr_registration_token'])));
        $data['url'] = $url;
        $mail = $this->container->get(Mail::class);
        //SETAMOS AS INFORMAÇÕES DE ENVIO
        $mail->setSubject('Por favor, confirme seu cadastro!')
            ->setTo($data['email'])
            ->setData($data)
            ->setViewTemplate('confirmacao');
        $mail->send();
    }


    /**
     * Quando o usuario clicar no email enviado
     * no momento do cadastro esta action ativara o cadastro
     * feito no site
     * @return ViewModel
     */
    public function confirmEmailAction() {
        $token = $this->params()->fromRoute('id');
        $template='/home/register/confirm-email-error';
        $viewModel = new ViewModel(array('token' => $token));
        $user = $this->getTable()->getUserByToken($token);
        if($user->getResult()){
            if($this->getTable()->activateUser($user->getData()->getId())){
                $template='/home/register/confirm-email';
            }
        }
        $viewModel->setTemplate($template);
        return $viewModel;
    }

    public function authenticateAction()
    {
        if($this->IdentityManager->hasIdentity()):
            $this->Messages()->flashInfo("VOCÊ JÁ ESTA LOGADO");
            return $this->redirect()->toRoute($this->route);
        endif;
        $viewModel=new ViewModel();
        $viewModel->setTemplate($this->template);
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
                    return $this->redirect()->toRoute($this->route);
                } else {
                    $this->Messages()->error("LOGIN OU SENHA INVALIDOS!");
                    $viewModel->setVariable('error', 'Login Error');
                }
            }
        }
        $viewModel->setVariable('form',$this->form);
        return $viewModel;

    }

    public function minhacontaAction()
    {
        if(!$this->IdentityManager->hasIdentity()):
            $this->Messages()->flashInfo("VOCÊ JÁ ESTA LOGADO");
            return $this->redirect()->toRoute('home');
        endif;
        $viewModel=new ViewModel(['user'=>$this->user]);
        $viewModel->setTemplate($this->template);
        return $viewModel;
    }

    public function logoutAction()
    {
        if ($this->getIdentityManager()->hasIdentity()) {
            $this->getIdentityManager()->logout();
        }
        return $this->redirect()->toRoute('home');
    }

    public function cache_usuarios_online(){
       $cache=new Cache();
            $data['id']="0";
            $data['title']=$this->getRequest()->getServer('REMOTE_ADDR');
            $data['images']="no_avatar.jpg";
            $data['email']="admin@hotmail.com";
            $data['data']=date("d-m-Y");
            $data['hora']=date("H:i:s");
            $url = sprintf("%s%s", $this->getRequest()->getServer('HTTP_ORIGIN'),$this->params()->fromRoute('action','index'));
            $data['url']=$url;
       if ($this->getIdentityManager()->hasIdentity()) {
             $data['title']=$this->user->title;
             $data['id']=$this->user->id;
             $data['images']=$this->user->images;
             $data['email']=$this->user->email;
        }

        $data['ip']=$this->getRequest()->getServer('REMOTE_ADDR');
        $data['agent']=$this->getRequest()->getServer('HTTP_USER_AGENT');
        $read_user_online=$cache->getItem('useronline');
      
        if($read_user_online){
            $read_user_online[\Base\Model\Check::Name($this->getRequest()->getServer('REMOTE_ADDR'))]=$data;
            //$read_user_online[$url]=$data;
            $cache->setItem('useronline',$read_user_online);
          }
        else{
            //$cache->setItem('useronline',[$url=>$data]);
            $cache->setItem('useronline',[\Base\Model\Check::Name($this->getRequest()->getServer('REMOTE_ADDR'))=>$data]);
        }

        $read_user_navigation=$cache->getItem('user_navigation');

        if($read_user_navigation){
            $read_user_navigation[$url]=$data;
            $cache->setItem('user_navigation',$read_user_navigation);
        }
        else{
           $cache->setItem('user_navigation',[$url=>$data]);
        }
        
     }

//\Base\Model\Check::Name($this->getRequest()->getServer('REMOTE_ADDR'))

}