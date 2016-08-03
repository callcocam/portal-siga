<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 27/07/2016
 * Time: 14:10
 */

namespace Admin\Model\Issusers;


use Base\Model\AbstractRepository;
use Zend\Db\TableGateway\TableGateway;

class IssusersRepository extends AbstractRepository{

    function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway=$tableGateway;
    }

    public function getEmpresas(){
        $datas=$this->findBy(['state'=>'0']);
        $valueOptions=[];
        if($datas->getData()->count())
        {
            foreach($datas->getData() as $data){
                $valueOptions[$data->getId()]=$data->getTitle();
            }

        }
        return $valueOptions;

    }
}