<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 21:24
 */

namespace Admin;



use Admin\Form\BancosFilter;
use Admin\Form\BancosForm;
use Admin\Form\ClientesFilter;
use Admin\Form\ClientesForm;
use Admin\Form\Factory\BancosFilterFactory;
use Admin\Form\Factory\BancosFormFactory;
use Admin\Form\Factory\ClientesFilterFactory;
use Admin\Form\Factory\ClientesFormFactory;
use Admin\Form\Factory\IssusersFilterFactory;
use Admin\Form\Factory\IssusersFormFactory;
use Admin\Form\IssusersFilter;
use Admin\Form\IssusersForm;
use Admin\Model\Bancos\Bancos;
use Admin\Model\Bancos\BancosRepository;
use Admin\Model\Bancos\Factory\BancosFactory;
use Admin\Model\Bancos\Factory\BancosRepositoryFactory;
use Admin\Model\Clientes\Clientes;
use Admin\Model\Clientes\Factory\ClientesRepositoryFactory;
use Admin\Model\Issusers\Factory\IssusersFactory;
use Admin\Model\Issusers\Factory\IssusersRepositoryFactory;
use Admin\Model\Issusers\Issusers;
use Admin\Model\Issusers\IssusersRepository;
use Admin\Model\Clientes\ClientesRepository;
use Admin\Model\Clientes\Factory\ClientesFactory;
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
        return include __DIR__ . '/../config/module.config.php';
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
               IssusersRepository::class=>IssusersRepositoryFactory::class,
               Issusers::class=>IssusersFactory::class,
                IssusersForm::class=>IssusersFormFactory::class,
                IssusersFilter::class=>IssusersFilterFactory::class,
                ClientesRepository::class=>ClientesRepositoryFactory::class,
                Clientes::class=>ClientesFactory::class,
                ClientesForm::class=>ClientesFormFactory::class,
                ClientesFilter::class=>ClientesFilterFactory::class,
                Bancos::class=>BancosFactory::class,
                BancosRepository::class=>BancosRepositoryFactory::class,
                BancosForm::class=>BancosFormFactory::class,
                BancosFilter::class=>BancosFilterFactory::class,
            ]

        ];
    }
}