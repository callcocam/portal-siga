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
use Portal\Form\Factory\CategoriasFilterFactory;
use Portal\Form\Factory\CategoriasFormFactory;
use Portal\Model\Categorias\Categorias;
use Portal\Model\Categorias\CategoriasRepository;
use Portal\Model\Categorias\Factory\CategoriasFactory;
use Portal\Model\Categorias\Factory\CategoriasRepositoryFactory;
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
          ]
        ];
    }
}