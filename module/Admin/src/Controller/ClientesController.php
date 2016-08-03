<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 27/07/2016
 * Time: 23:07
 */

namespace Admin\Controller;



use Admin\Form\ClientesFilter;
use Admin\Form\ClientesForm;
use Admin\Model\Clientes\Clientes;
use Admin\Model\Clientes\ClientesRepository;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ClientesController extends AbstractController {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=ClientesRepository::class;
        $this->model=Clientes::class;
        $this->form=ClientesForm::class;
        $this->filter=ClientesFilter::class;
        $this->route="clientes";
        $this->controller="clientes";
    }
}