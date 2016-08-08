<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Cidadeonline\Form\PostsFilter;
use Cidadeonline\Form\PostsForm;
use Cidadeonline\Model\Posts\Posts;
use Cidadeonline\Model\Posts\PostsRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class PostsController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $container
     * @return \Cidadeonline\Controller\PostsController
     */
    public function __construct(ContainerInterface $container)
    {
        // Configurações iniciais do Controller
        $this->container=$container;
        $this->table=PostsRepository::class;
        $this->model=Posts::class;
        $this->form=PostsForm::class;
        $this->filter=PostsFilter::class;
        $this->route="posts";
        $this->controller="posts";
    }


}

