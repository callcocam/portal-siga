<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:27
 */

namespace Auth\Controller;


use Auth\Form\ResourcesFilter;
use Auth\Form\ResourcesForm;
use Auth\Model\Resources\Resources;
use Auth\Model\Resources\ResourcesRepository;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ResourcesController extends AbstractController {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=ResourcesRepository::class;
        $this->model=Resources::class;
        $this->form=ResourcesForm::class;
        $this->filter=ResourcesFilter::class;
        $this->controller="resources";
        $this->route="resources";
    }
}