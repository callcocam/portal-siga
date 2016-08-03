<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 27/07/2016
 * Time: 14:12
 */

namespace Admin\Model\Issusers\Factory;



use Admin\Model\Issusers\Issusers;
use Admin\Model\Issusers\IssusersRepository;
use Base\Model\Factory\AbstractFactory;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class IssusersRepositoryFactory extends AbstractFactory implements FactoryInterface{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
      return new IssusersRepository($this->tableGateway('bs_issusers',Issusers::class,$container));
    }
}