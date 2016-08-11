<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Cidadeonline\Form\ClientesFilter;
use Cidadeonline\Form\ClientesForm;
use Cidadeonline\Model\Clientes\Clientes;
use Cidadeonline\Model\Clientes\ClientesRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ClientesController extends AbstractController
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
        $this->table=ClientesRepository::class;
        $this->model=Clientes::class;
        $this->form=ClientesForm::class;
        $this->filter=ClientesFilter::class;
        $this->route="clientes";
        $this->controller="clientes";
    }


}

