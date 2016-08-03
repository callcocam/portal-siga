<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:19
 */

namespace Admin\Model\Clientes;


use Base\Model\AbstractRepository;
use Zend\Db\TableGateway\TableGateway;


class ClientesRepository extends AbstractRepository{

    /**
     * @param TableGateway $tableGateway
     */
    function __construct(TableGateway $tableGateway)
    {
        // TODO: Implement __construct() method.
        $this->tableGateway = $tableGateway;
    }

}