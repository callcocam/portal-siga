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
use Home\Form\RegisterFilter;
use Home\Form\RegisterForm;
use Interop\Container\ContainerInterface;
use Cidadeonline\Model\Posts\Posts;
use Cidadeonline\Model\Posts\PostsRepository;
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
    }

    public function indexAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/index');
        return $ViewModel;
    }
    
    /**
     * @return ViewModel
     */
    public function postsAction()
    {
        $this->cache_usuarios_online();
        $this->table=PostsRepository::class;
        $this->model=Posts::class;
        $this->getTable()->postViews($this->id);
        $ViewModel=new ViewModel(['id'=>$this->id,'route'=>'comentarios','page'=>'1','user'=>$this->user]);
        $ViewModel->setTemplate('/cidadeonline/portal/posts');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function empresaAction()
    {
        $this->cache_usuarios_online();
        $this->table=EmpresasRepository::class;
        $this->model=Empresas::class;
        $this->getTable()->empresasViews($this->id);
        $ViewModel=new ViewModel(['id'=>$this->id,'route'=>'comentarios','page'=>'1','user'=>$this->user]);
        $ViewModel->setTemplate('/cidadeonline/portal/empresa');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function classificadosAction()
    {
        $this->cache_usuarios_online();
        $this->table=ClassificadosRepository::class;
        $this->model=Classificados::class;
        $this->getTable()->classificadosViews($this->id);
        $ViewModel=new ViewModel(['id'=>$this->id,'route'=>'comentarios','page'=>'1','user'=>$this->user]);
        $ViewModel->setTemplate('/cidadeonline/portal/classificados');
        return $ViewModel;
    }

     /**
     * @return ViewModel
     */
    public function categoriasAction()
    {
        $this->cache_usuarios_online();
       $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/categorias');
        return $ViewModel;
    }

     /**
     * @return ViewModel
     */
    public function ramoAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/ramo');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function noticiasAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/noticias');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function blogpostsAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/blog-posts');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function blogautorAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/blog-autor');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondecomprarAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/cidadeonline/portal/ramo');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function ondeficarAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/cidadeonline/portal/ramo');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondesedivertirAction()
    {       
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/cidadeonline/portal/ramo');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondecomerAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/cidadeonline/portal/ramo');
        return $ViewModel;
    }

    public function classificadolistaAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/cidadeonline/portal/classificados-categoria');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function contatoAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/cidadeonline/portal/contato');
        return $ViewModel;
    }

    public function contactAction()
    {
        $this->cache_usuarios_online();
        return new JsonModel();
    }

    public function commentsAction(){
        $this->table=ComentariosRepository::class;
        $this->model=Comentarios::class;
        $this->form=ComentariosForm::class;
        $this->filter=ComentariosFilter::class;
        return parent::finalizaAction();
    }

    public function loadcommentspostsAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'parent'=>'post','route'=>'comentarios','page'=>'1','user'=>$this->user]);
        $ViewModel->setTemplate('/cidadeonline/portal/widget/comments-post');
        return $ViewModel;
    }
    public function loadcommentsempresasAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'parent'=>'empresa','route'=>'comentarios','page'=>'1','user'=>$this->user]);
        $ViewModel->setTemplate('/cidadeonline/portal/widget/comments-post');
        return $ViewModel;
    }

    public function loadcommentsclassificadosAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'parent'=>'classificado','route'=>'comentarios','page'=>'1','user'=>$this->user]);
        $ViewModel->setTemplate('/cidadeonline/portal/widget/comments-post');
        return $ViewModel;
    }


    /*
     * A PARTIR DAQUI FICA A MANUTENÇÃO DO USUARIO
     */

    public function cadastroAction(){
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'route'=>'comentarios','page'=>'1','user'=>$this->user]);
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
        $ViewModel=new ViewModel(['id'=>$this->id,'route'=>'cidadeonline','page'=>'1','user'=>$this->user]);
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

    public function novoanuncioAction()
    {
        $this->cache_usuarios_online();
        $ViewModel=new ViewModel(['id'=>$this->id,'route'=>'cidadeonline','page'=>'1','user'=>$this->user]);
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