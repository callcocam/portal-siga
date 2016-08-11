<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 04/08/2016
 * Time: 17:08
 */

namespace Cidadeonline\Controller;


use Auth\Model\Users\Users;
use Auth\Model\Users\UsersRepository;
use Base\Model\Cache;
use Cidadeonline\Form\ComentariosFilter;
use Cidadeonline\Form\ComentariosForm;
use Cidadeonline\Form\EmpresasFilter;
use Cidadeonline\Form\EmpresasForm;
use Cidadeonline\Model\Classificados\Classificados;
use Cidadeonline\Model\Classificados\ClassificadosRepository;
use Cidadeonline\Form\ClassificadosFilter;
use Cidadeonline\Form\ClassificadosForm;
use Cidadeonline\Model\Comentarios\Comentarios;
use Cidadeonline\Model\Comentarios\ComentariosRepository;
use Cidadeonline\Model\Empresas\Empresas;
use Cidadeonline\Model\Empresas\EmpresasRepository;
use Home\Controller\AbstractController;
use Home\Form\AuthForm;
use Home\Form\ProfileFilter;
use Home\Form\ProfileForm;
use Home\Form\RegisterFilter;
use Home\Form\RegisterForm;
use Interop\Container\ContainerInterface;
use Cidadeonline\Model\Posts\Posts;
use Cidadeonline\Model\Posts\PostsRepository;
use Mail\Form\MailFilter;
use Mail\Form\MailForm;
use Mail\Service\Mail;
use Zend\Debug\Debug;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\AdapterInterface;

class CidadeonlineController extends AbstractController {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->form=ComentariosForm::class;
        $this->filter=ComentariosFilter::class;
        $this->route="cidadeonline-pages";

    }

    public function indexAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/index');
        return $ViewModel;
    }

    // RELACIONADO A POSTS
    
    /**
     * @return ViewModel
     */
    public function postsAction()
    {
        $this->cache_usuarios_online();
        $this->table=PostsRepository::class;
        $this->model=Posts::class;
        $this->getTable()->postViews($this->id);
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/posts');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function noticiasAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/noticias');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function postslistAction()
    {
       $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/posts-list');
        return $ViewModel;
    }

    /**
     * Lista os post pelo url do autor
     * @return ViewModel
     */
    public function postslistautorAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/posts-list-autor');
        return $ViewModel;
    }

    /**
     * Carrega os comentarios do post via ajax no momento da ação comentar
     * @return ViewModel
     */
    public function loadcommentspostsAction()
        {
            $ViewModel=new ViewModel($this->search);
            $ViewModel->setTemplate('/cidadeonline/portal/widget/comments-post');
            return $ViewModel;
        }

        //GERAL

        public function sobrenosAction()
        {
            $ViewModel=new ViewModel($this->search);
            $ViewModel->setTemplate('/cidadeonline/portal/sobre-nos');
            return $ViewModel;
        }

        public function termosdeusoAction()
        {
            $ViewModel=new ViewModel($this->search);
            $ViewModel->setTemplate('/cidadeonline/portal/termos-de-uso');
            return $ViewModel;
        }

        public function politicadeprivacidadeAction()
        {
            $ViewModel=new ViewModel($this->search);
            $ViewModel->setTemplate('/cidadeonline/portal/politica-de-privacidade');
            return $ViewModel;
        }
        public function perguntasfrequentesAction()
            {
                $ViewModel=new ViewModel($this->search);
                $ViewModel->setTemplate('/cidadeonline/portal/perguntas-frequentes');
                return $ViewModel;
            }

//RELACIONADO A EMPRESAS

    /**
     * @return ViewModel
     */
    public function empresaAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $this->table=EmpresasRepository::class;
        $this->model=Empresas::class;
        $this->getTable()->empresasViews($this->id);
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/empresa');
        return $ViewModel;
    }

     /**
     * @return ViewModel
     */
    public function categoriasAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
       $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/categorias');
        return $ViewModel;
    }

     /**
     * @return ViewModel
     */
    public function ramoAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/empresas-list');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondecomprarAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/empresas-list');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function ondeficarAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/empresas-list');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondesedivertirAction()
    {       
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/empresas-list');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondecomerAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/empresas-list');
        return $ViewModel;
    }

    public function loadcommentsempresasAction()
    {
        $this->search['parent']='empresa';
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/widget/comments-post');
        return $ViewModel;
    }

    public function minhacontaAction()
    {
        $this->cache_usuarios_online();
        $this->template='/cidadeonline/portal/minha-conta';
        return parent::minhacontaAction();
    }

    public function minhaempresaAction()
    {
        $this->cache_usuarios_online();
        $this->template='/cidadeonline/portal/minha-empresa';
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/minha-empresa');
        return $ViewModel;
    }
    public function atualizaempresaAction()
    {
        $this->cache_usuarios_online();
        $this->table=EmpresasRepository::class;
        $this->model=Empresas::class;
        $this->filter=EmpresasFilter::class;
        $this->form=EmpresasForm::class;
        return parent::finalizaAction();
    }


//RELACIONADO A CLASSIFICADOS
    /**
     * @return ViewModel
     */
    public function classificadosAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $this->table=ClassificadosRepository::class;
        $this->model=Classificados::class;
        $this->getTable()->classificadosViews($this->id);
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/classificados');
        return $ViewModel;
    }


    public function classificadolistaAction()
    {
        $this->cache_usuarios_online();
        if($this->getData()){
            $this->search['filtro']=$this->getData();
        }
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/classificados-categoria');
        return $ViewModel;
    }


    public function removerclassificadoAction()
    {
        $id=$this->params()->fromRoute('id');
        if(!(int)$id){
            $this->Messages()->flashError("ERROR: O Anuncio Selecionado Não Foi Encotrado!");
            return $this->redirect()->toRoute($this->route,['action'=>'minha-conta']);
        }
        $this->table=ClassificadosRepository::class;
        $this->model=Classificados::class;
        $resutl=$this->getTable()->delete($id);
        if($resutl->getResult()){
            $this->Messages()->flashSuccess("OPPSS: O Anuncio Foi Excluido Com Sucesso!");
            return $this->redirect()->toRoute($this->route,['action'=>'minha-conta']);
        }
        $this->Messages()->flashError("ERROR: O Anuncio Selecionado Não Pode Ser Excluido!");
        return $this->redirect()->toRoute($this->route,['action'=>'minha-conta']);
    }

    public function loadcommentsclassificadosAction()
    {
        $this->search['parent']='classificado';
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/widget/comments-post');
        return $ViewModel;
    }

     public function novoanuncioAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/novo-anuncio');
        return $ViewModel;
    }

    public function finalizaanucioAction()
    {
        $this->table=ClassificadosRepository::class;
        $this->model=Classificados::class;
        $this->filter=ClassificadosFilter::class;
        $this->form=ClassificadosForm::class;
        return parent::finalizaAction();
    }

    //RELACIONADO A CONTATO

    /**
     * @return ViewModel
     */
    public function contatoAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/contato');
        return $ViewModel;
    }

    public function contactAction()
    {
        $result=false;
        $classe='alert alert-danger';
          if($this->getData()){
            $url = sprintf("%s", $this->getRequest()->getServer('HTTP_ORIGIN'));
             try{
                /**
                 * @var $mail Mail
                 */
                $this->form=MailForm::class;
                $this->filter=MailFilter::class;
                $this->form=$this->getForm();
                $inputfilter=$this->getFilter();
                $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
                $inputfilter->data=$this->data;
                $this->form->setInputFilter($inputfilter->getInputFilter());
                $this->form->setData($this->data);
                if ($this->form->isValid()) {
                    $this->data['url'] = $url;
                    $mail = $this->container->get(Mail::class);
                    //SETAMOS AS INFORMAÇÕES DE ENVIO
                    $mail->setSubject(sprintf("ASSUNTO: %s",$this->data['subject']))
                        ->setTo($this->config->email_contato)
                        ->setData($this->data)
                        ->setViewTemplate('contato');
                    $mail->send();
                    $result=true;
                    $classe="alert alert-success";
                    $error[]="OPPSS! Seu Contato Foi Recebido Com Sucesso Logo Entraremos Em Contato";
                }
                else{
                    $classe='alert alert-danger';
                    $error=[];
                    foreach ($this->form->getMessages() as $key=> $messages){
                        foreach($messages as  $ms){
                            $error[$key]=sprintf("[%s-%s]",$key,$ms);
                        }
                    }

                }

            }catch (\Exception $e){
                $result=true;
                $error[]=$e->getMessage();
                 $classe='alert alert-danger';
            }
        }
        else{
            $error[]="OPPSS! Dados Invalidos";

        }
        return new JsonModel(['result'=>$result,"error"=>implode(PHP_EOL,$error),'classe'=>$classe]);
    }


    //RELACONADO A COMENTARIOS
    public function commentsAction(){
        $this->table=ComentariosRepository::class;
        $this->model=Comentarios::class;
        $this->form=ComentariosForm::class;
        $this->filter=ComentariosFilter::class;
        return parent::finalizaAction();
    }
  

    /*
     * A PARTIR DAQUI FICA A MANUTENÇÃO DO USUARIO
     */

    public function cadastroAction(){
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel($this->search);
        $ViewModel->setTemplate('/cidadeonline/portal/cadastro');
        if (!$this->getData()) {
            return $ViewModel;
        }
        $this->table=UsersRepository::class;
        $this->model=Users::class;
        $this->filter=RegisterFilter::class;
        $this->form=RegisterForm::class;
        $this->form=$this->getForm();
        $this->form->setData($this->data);
        $model=$this->getModel();
        $inputfilter=$this->getFilter();
        $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
        $this->form->setInputFilter($inputfilter->getInputFilter());
        if (! $this->form->isValid()) {
            $this->Messages()->error("OS DADOS PASSADOS SÃO INVALIDOS");
            return $ViewModel;
        }
        try {
            $this->prepareData($this->data);
            $model->exchangeArray($this->data);
            $this->getTable()->insert($model);
            if($this->getTable()->getData()->getResult()){
                $this->Messages()->flashSuccess(sprintf('An e-mail has been sent to %s. Please, check your inbox and confirm your registration!', $this->data['email']));
                $this->sendConfirmationEmail($this->data);
            }
            else{
                $this->Messages()->error($this->getTable()->getData()->getError());
                return $ViewModel;
            }

        } catch (\Exception $ex) {
            throw $ex;
        }
        return $this->redirect()->toRoute('cidadeonline-pages',['action'=>'cadastro']);
    }


    public function profileAction(){
        $this->table=UsersRepository::class;
        $this->model=Users::class;
        $this->form=ProfileForm::class;
        $this->filter=ProfileFilter::class;
        $result=parent::finalizaAction();

        return $result;
    }

    public function getufAction()
    {
        $id=$this->params()->fromRoute('id');
        $uf['uf']="SC";
        $cache=new Cache();
        if($cache->hasItem('data-cidedes')){
            $cidade=$cache->getItem('data-cidedes');
            $uf=$cidade[$id];
        }
        return new JsonModel($uf);
    }

    public function loginAction()
    {
        $this->cache_usuarios_online();
        $this->form=AuthForm::class;
        $this->route='home';
        $this->template='/cidadeonline/portal/login';
        return parent::authenticateAction();

    }

    public function logoutAction()
    {
        return parent::logoutAction();
    }


}