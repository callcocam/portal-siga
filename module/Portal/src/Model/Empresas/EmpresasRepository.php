<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Model\Empresas;

use Base\Model\AbstractModel;
use Base\Model\Check;
use Zend\Db\TableGateway\TableGateway;
use Base\Model\AbstractRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class EmpresasRepository extends AbstractRepository
{

    /**
     * __construct Factory Model
     *
     * @param TableGateway $tableGateway
     * @return \Portal\Model\Empresas\EmpresasRepository
     */
    public function __construct(TableGateway $tableGateway)
    {
        // Configurações iniciais do Factory Repository
        $this->tableGateway=$tableGateway;
    }

    public function insert(AbstractModel $model){
        $model->setUrl(Check::Name($model->getTitle()));
        $exist=$this->findBy(['url'=>$model->getUrl()]);
        if($exist->getResult())
        {
            $url=sprintf("%s-%s",$model->getUrl(),date('YmdHis'));
            $model->setUrl($url);
        }

        return parent::insert($model);
    }

}

