<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:19
 */

namespace Auth\Model\Privileges;


use Base\Model\AbstractRepository;
use Zend\Db\TableGateway\TableGateway;

class PrivilegesRepository extends AbstractRepository {

    function __construct(TableGateway $tableGateway)
    {
       $this->tableGateway = $tableGateway;
    }
}