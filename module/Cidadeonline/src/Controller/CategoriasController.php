<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Cidadeonline\Form\CategoriasFilter;
use Cidadeonline\Form\CategoriasForm;
use Cidadeonline\Model\Categorias\Categorias;
use Cidadeonline\Model\Categorias\CategoriasRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class CategoriasController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $container
     * @return \Cidadeonline\Controller\CategoriasController
     */
    public function __construct(ContainerInterface $container)
    {
        // Configurações iniciais do Controller
        $this->container=$container;
        $this->table=CategoriasRepository::class;
        $this->model=Categorias::class;
        $this->form=CategoriasForm::class;
        $this->filter=CategoriasFilter::class;
        $this->route="categorias";
        $this->controller="categorias";
    }


}

