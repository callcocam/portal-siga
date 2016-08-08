<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Cidadeonline\Form\ComentariosFilter;
use Cidadeonline\Form\ComentariosForm;
use Cidadeonline\Model\Comentarios\Comentarios;
use Cidadeonline\Model\Comentarios\ComentariosRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ComentariosController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $container
     * @return \Cidadeonline\Controller\ComentariosController
     */
    public function __construct(ContainerInterface $container)
    {
        // Configurações iniciais do Controller
        $this->container=$container;
        $this->table=ComentariosRepository::class;
        $this->model=Comentarios::class;
        $this->form=ComentariosForm::class;
        $this->filter=ComentariosFilter::class;
        $this->route="comentarios";
        $this->controller="comentarios";
    }


}

