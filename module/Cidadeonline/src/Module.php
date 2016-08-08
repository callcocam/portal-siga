<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:20
 */

namespace Cidadeonline;



use Cidadeonline\Form\CategoriasFilter;
use Cidadeonline\Form\CategoriasForm;
use Cidadeonline\Form\ClassificadosFilter;
use Cidadeonline\Form\ClassificadosForm;
use Cidadeonline\Form\ComentariosFilter;
use Cidadeonline\Form\ComentariosForm;
use Cidadeonline\Form\EmpresasFilter;
use Cidadeonline\Form\EmpresasForm;
use Cidadeonline\Form\Factory\CategoriasFilterFactory;
use Cidadeonline\Form\Factory\CategoriasFormFactory;
use Cidadeonline\Form\Factory\ClassificadosFilterFactory;
use Cidadeonline\Form\Factory\ClassificadosFormFactory;
use Cidadeonline\Form\Factory\ComentariosFilterFactory;
use Cidadeonline\Form\Factory\ComentariosFormFactory;
use Cidadeonline\Form\Factory\EmpresasFilterFactory;
use Cidadeonline\Form\Factory\EmpresasFormFactory;
use Cidadeonline\Form\Factory\PostsFilterFactory;
use Cidadeonline\Form\Factory\PostsFormFactory;
use Cidadeonline\Form\PostsFilter;
use Cidadeonline\Form\PostsForm;
use Cidadeonline\Model\Categorias\Categorias;
use Cidadeonline\Model\Categorias\CategoriasRepository;
use Cidadeonline\Model\Categorias\Factory\CategoriasFactory;
use Cidadeonline\Model\Categorias\Factory\CategoriasRepositoryFactory;
use Cidadeonline\Model\Classificados\Classificados;
use Cidadeonline\Model\Classificados\ClassificadosRepository;
use Cidadeonline\Model\Classificados\Factory\ClassificadosFactory;
use Cidadeonline\Model\Classificados\Factory\ClassificadosRepositoryFactory;
use Cidadeonline\Model\Comentarios\Comentarios;
use Cidadeonline\Model\Comentarios\ComentariosRepository;
use Cidadeonline\Model\Comentarios\Factory\ComentariosFactory;
use Cidadeonline\Model\Comentarios\Factory\ComentariosRepositoryFactory;
use Cidadeonline\Model\Empresas\Empresas;
use Cidadeonline\Model\Empresas\EmpresasRepository;
use Cidadeonline\Model\Empresas\Factory\EmpresasFactory;
use Cidadeonline\Model\Empresas\Factory\EmpresasRepositoryFactory;
use Cidadeonline\Model\Posts\Factory\PostsFactory;
use Cidadeonline\Model\Posts\Factory\PostsRepositoryFactory;
use Cidadeonline\Model\Posts\Posts;
use Cidadeonline\Model\Posts\PostsRepository;
use Cidadeonline\View\Helper\CidadeonlineHelper;
use Interop\Container\ContainerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ConfigProviderInterface,ServiceProviderInterface,ViewHelperProviderInterface{

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
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

                Comentarios::class=>ComentariosFactory::class,

                ComentariosRepository::class=>ComentariosRepositoryFactory::class,

                ComentariosForm::class=>ComentariosFormFactory::class,

                ComentariosFilter::class=>ComentariosFilterFactory::class,
            ],
            'invokables'=>[


            ]

        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'factories'=>[
                'CidadeonlineHelper'=>function(ContainerInterface $container){
                    return new CidadeonlineHelper($container);
                }
            ],
            'invokables'=>[

            ]

        ];
    }
}