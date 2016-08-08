<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 10:11
 */

namespace Portal;


use Portal\Form\CategoriasFilter;
use Portal\Form\CategoriasForm;
use Portal\Form\ClassificadosFilter;
use Portal\Form\ClassificadosForm;
use Portal\Form\EmpresasFilter;
use Portal\Form\EmpresasForm;
use Portal\Form\Factory\CategoriasFilterFactory;
use Portal\Form\Factory\CategoriasFormFactory;
use Portal\Form\Factory\ClassificadosFilterFactory;
use Portal\Form\Factory\ClassificadosFormFactory;
use Portal\Form\Factory\EmpresasFilterFactory;
use Portal\Form\Factory\EmpresasFormFactory;
use Portal\Form\Factory\PostsFilterFactory;
use Portal\Form\Factory\PostsFormFactory;
use Portal\Form\PostsFilter;
use Portal\Form\PostsForm;
use Portal\Model\Categorias\Categorias;
use Portal\Model\Categorias\CategoriasRepository;
use Portal\Model\Categorias\Factory\CategoriasFactory;
use Portal\Model\Categorias\Factory\CategoriasRepositoryFactory;
use Portal\Model\Classificados\Classificados;
use Portal\Model\Classificados\ClassificadosRepository;
use Portal\Model\Classificados\Factory\ClassificadosFactory;
use Portal\Model\Classificados\Factory\ClassificadosRepositoryFactory;
use Portal\Model\Empresas\Empresas;
use Portal\Model\Empresas\EmpresasRepository;
use Portal\Model\Empresas\Factory\EmpresasFactory;
use Portal\Model\Empresas\Factory\EmpresasRepositoryFactory;
use Portal\Model\Posts\Factory\PostsFactory;
use Portal\Model\Posts\Factory\PostsRepositoryFactory;
use Portal\Model\Posts\Posts;
use Portal\Model\Posts\PostsRepository;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements ConfigProviderInterface, ServiceProviderInterface{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__."/../config/module.config.php";
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return [
          'factories'=>[
              Categorias::class=>CategoriasFactory::class,

              CategoriasRepository::class=>CategoriasRepositoryFactory::class,

              CategoriasForm::class=>CategoriasFormFactory::class,

              CategoriasFilter::class=>CategoriasFilterFactory::class,

              Empresas::class=>EmpresasFactory::class,

              EmpresasRepository::class=>EmpresasRepositoryFactory::class,

              EmpresasForm::class=>EmpresasFormFactory::class,

              EmpresasFilter::class=>EmpresasFilterFactory::class,

              Posts::class=>PostsFactory::class,

              PostsRepository::class=>PostsRepositoryFactory::class,

              PostsForm::class=>PostsFormFactory::class,

              PostsFilter::class=>PostsFilterFactory::class,

              Classificados::class=>ClassificadosFactory::class,

              ClassificadosRepository::class=>ClassificadosRepositoryFactory::class,

              ClassificadosForm::class=>ClassificadosFormFactory::class,

              ClassificadosFilter::class=>ClassificadosFilterFactory::class,
          ]
        ];
    }
}