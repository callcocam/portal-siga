<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:19
 */

namespace Auth\Model\Resources;


use Base\Model\AbstractRepository;
use Zend\Db\TableGateway\TableGateway;

class ResourcesRepository extends AbstractRepository {

    /**
     * @param TableGateway $tableGateway
     */
    function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
}