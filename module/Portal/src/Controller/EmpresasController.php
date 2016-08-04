<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Portal\Form\EmpresasFilter;
use Portal\Form\EmpresasForm;
use Portal\Model\Empresas\Empresas;
use Portal\Model\Empresas\EmpresasRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class EmpresasController extends AbstractController
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
        $this->table=EmpresasRepository::class;
        $this->model=Empresas::class;
        $this->form=EmpresasForm::class;
        $this->filter=EmpresasFilter::class;
        $this->route="empresas";
        $this->controller="empresas";
    }


}

