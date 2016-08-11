<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Model\Clientes\Factory;

use Base\Model\Factory\AbstractFactory;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Cidadeonline\Model\Clientes\ClientesRepository;
use Cidadeonline\Model\Clientes\Clientes;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ClientesRepositoryFactory extends AbstractFactory implements FactoryInterface
{

    /**
     * __invoke Factory Model
     *
     * @return __invoke
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        // Configurações iniciais do Factory Table
        return new ClientesRepository($this->tableGateway("bs_users",Clientes::class,$container));
    }


}

