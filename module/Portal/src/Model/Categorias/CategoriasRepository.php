<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Model\Categorias;

use Base\Model\AbstractModel;
use Base\Model\Check;
use Zend\Db\TableGateway\TableGateway;
use Base\Model\AbstractRepository;
use Zend\Debug\Debug;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class CategoriasRepository extends AbstractRepository
{

    /**
     * __construct Factory Model
     *
     * @param TableGateway $tableGateway
     * @return \Portal\Model\Categorias\CategoriasRepository
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

    public function parentCat($param,$parent_id=false)
    {
        $cats=$this->findBy($param);
        $valueOptions=[''=>'--CATEGORIA PAI--'];
        if($cats->getResult())
        {
            foreach($cats->getData() as $cat){
                if($parent_id==$cat->getParentId()){
                    $valueOptions[$cat->getId()]=$cat->getTitle();
                }

            }

        }
        return $valueOptions;
    }

    public function getGategorias($param=['state' => '0'])
    {
        $dados=$this->findBy($param);
        $valueOptions = ['' => '--CATEGORIA PAI--'];
        if ($dados->getResult()):
            foreach ($dados->getData() as $value):
                $subCategoria = $this->findBy(['state' => '0', 'parent_id' => $value->getId()]);
                $valueOptionsSubCat = [];
                if ($subCategoria->getResult()):
                    foreach ($subCategoria->getData() as $subCat) {
                        $valueOptionsSubCat[$subCat->getId()] ="--{$subCat->getTitle()}";
                    }
                endif;
                $valueOptions[$value->getId()] = ["label" => $value->getTitle(), "options" => $valueOptionsSubCat];
            endforeach;
        endif;
        return $valueOptions;
    }


}

