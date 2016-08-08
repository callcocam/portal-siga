<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 04/08/2016
 * Time: 17:08
 */

namespace Home\Controller;


use Interop\Container\ContainerInterface;
use Portal\Model\Posts\Posts;
use Portal\Model\Posts\PostsRepository;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class PortalController extends AbstractController {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
    }

    
    /**
     * @return ViewModel
     */
    public function postsAction()
    {
        $this->table=PostsRepository::class;
        $this->model=Posts::class;
        $this->getTable()->postViews($this->id);
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/posts');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function empresaAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/empresa');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function classificadosAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/classificados');
        return $ViewModel;
    }

     /**
     * @return ViewModel
     */
    public function categoriasAction()
    {
       $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/categorias');
        return $ViewModel;
    }

     /**
     * @return ViewModel
     */
    public function ramoAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/ramo');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function noticiasAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/noticias');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function blogpostsAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/blog-posts');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function blogautorAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/blog-autor');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondecomprarAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/home/portal/ramo');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function ondeficarAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/home/portal/ramo');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondesedivertirAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/home/portal/ramo');
        return $ViewModel;
    }

    /**
     * @return ViewModel
     */
    public function ondecomerAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id,'action'=>$this->params()->fromRoute('action')]);
        $ViewModel->setTemplate('/home/portal/ramo');
        return $ViewModel;
    }


    /**
     * @return ViewModel
     */
    public function contatoAction()
    {
        $ViewModel=new ViewModel(['id'=>$this->id]);
        $ViewModel->setTemplate('/home/portal/contato');
        return $ViewModel;
    }

    public function contactAction()
    {
        return new JsonModel();
    }






}