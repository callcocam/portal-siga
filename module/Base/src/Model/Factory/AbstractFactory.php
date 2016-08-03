<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 09:03
 */

namespace Base\Model\Factory;


use Base\Model\AbstractRepository;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class AbstractFactory  {

    public function tableGateway($table,$model,ContainerInterface $container){
        $resultSet=new ResultSet();
        $resultsetpropotype=$resultSet->setArrayObjectPrototype($container->get($model));
        return new TableGateway($table,$container->get(AdapterInterface::class),null,$resultsetpropotype);
    }
} 