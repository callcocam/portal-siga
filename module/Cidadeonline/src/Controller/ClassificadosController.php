<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Cidadeonline\Form\ClassificadosFilter;
use Cidadeonline\Form\ClassificadosForm;
use Cidadeonline\Model\Classificados\Classificados;
use Cidadeonline\Model\Classificados\ClassificadosRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ClassificadosController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $container
     * @return \Cidadeonline\Controller\ClassificadosController
     */
    public function __construct(ContainerInterface $container)
    {
        // Configurações iniciais do Controller
        $this->container=$container;
        $this->table=ClassificadosRepository::class;
        $this->model=Classificados::class;
        $this->form=ClassificadosForm::class;
        $this->filter=ClassificadosFilter::class;
        $this->route="classificados";
        $this->controller="classificados";
    }


}

