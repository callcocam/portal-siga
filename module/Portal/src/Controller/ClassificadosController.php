<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Portal\Form\ClassificadosFilter;
use Portal\Form\ClassificadosForm;
use Portal\Model\Classificados\Classificados;
use Portal\Model\Classificados\ClassificadosRepository;

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
     * @return __construct
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

