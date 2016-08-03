<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Admin\Form\BancosFilter;
use Admin\Form\BancosForm;
use Admin\Model\Bancos\Bancos;
use Admin\Model\Bancos\BancosRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class BancosController extends AbstractController
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
        $this->table=BancosRepository::class;
        $this->model=Bancos::class;
        $this->form=BancosForm::class;
        $this->filter=BancosFilter::class;
        $this->route="bancos";
        $this->controller="bancos";
    }


}

