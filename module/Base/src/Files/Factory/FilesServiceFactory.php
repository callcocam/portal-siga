<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 25/07/2016
 * Time: 18:42
 */

namespace Base\Files\Factory;


use Base\Files\FilesInputFilter;
use Base\Files\FilesOptions;
use Base\Files\FilesService;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class FilesServiceFactory implements FactoryInterface {

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
        $options=new FilesOptions($container);
        return new FilesService($options);
    }
}