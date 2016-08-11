<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 09:03
 */

namespace Base\Model;


use Zend\Db\Adapter\Exception\InvalidQueryException;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Predicate\Operator;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;
use Zend\Validator\Digits;
use Zend\Paginator\Adapter;


abstract class AbstractRepository{

    const ERROR = 'danger';
    const SUCCESS = 'success';
    const INFO = 'info';

    /**
     * @var $tableGateway TableGateway
     */
    protected $tableGateway;

    /**
    * @var $data Result
    */
    protected $data;

    protected $where;

    protected $columns;

    protected $joins;


    abstract  function __construct(TableGateway $tableGateway);

    public function getTable()
    {
        return $this->tableGateway->getTable();
    }

    public function select($where = null,$page=1,$itemPage=8)
    {
        $this->setData();
        //abrir zend db sql e iniciar um select
        $select = $this->tableGateway->getSql()->select();
        if ($this->columns):
            $select->columns($this->columns);
            //
        endif;
        //verificar e monta as união de tabelas vindas de sua table real
        if ($this->joins):
            foreach ($this->joins as $j):
                $select->join($j['tabela'], $j['w'], $j['c'], $j['predicate']);
            endforeach;
        endif;

        $this->filtro($where);
        $select->where($this->where);
        $select->order(['created'=>"DESC"]);
        $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $results = $statement->execute();
        $resultSet = new ResultSet(); //$this->tableGateway->getResultSetPrototype();
        $resultSet->initialize($results);
        $paginator=new MyPaginator(new Adapter\ArrayAdapter($resultSet->toArray()));
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($itemPage);
        // clear all the cache data
        $this->data->setData($paginator);
        $this->data->setClass(self::SUCCESS);
        $this->data->setResult(TRUE);
        return $this->data;
    }

    public function filtro($condicao){
        $this->where = new  Where();
        if(isset($condicao['asset_id']))
        {
            // $operator=$condicao['state']>=0?"=":">";
            $this->where->addPredicate(new  Operator("{$this->getTable()}.asset_id", "=",$condicao['asset_id']));
        }
        if(isset($condicao['state']) && $condicao['state']>=0)
        {
           // $operator=$condicao['state']>=0?"=":">";
            $this->where->addPredicate(new  Operator("{$this->getTable()}.state", "=",$condicao['state']));
        }
        if(isset($condicao['busca']) && !empty($condicao['busca']))
        {
            $this->where->expression("CONCAT_WS(' ', {$this->getTable()}.title, {$this->getTable()}.description) LIKE ?", "%{$condicao['busca']}%");
        }
        return  $this->where;

    }

    /**
     * Retorna um registro com base no id
     * @param $id do registro
     * @param bool $object se true retorna um object AbstractModel se false um array
     * @return array|\ArrayObject|null
     */
    public function find($id,$object=true)
    {
        $this->setData();
        $data=$this->tableGateway->select(['id'=>$id]);
        if($data->count()):
            if($object):
                $this->data->setData($data->current());
            else:
                $this->data->setData($data->current()->toArray());
            endif;
            $this->data->setResult(TRUE);
            $this->data->setClass(self::SUCCESS);
            return $this->data;
        endif;
        $this->data->setResult(false);
        $this->data->setClass(self::INFO);
        $this->data->setError("NEMHUM RESULTADO FOI ENCOTADO PARA A SUA PESQUISA");
        return $this->data;
    }

    /**
     * Consulta registro passnaddo um array com um ou mais parametro(s)
     * @param array $param
     * @return type object table bd
     */
    public function findBy(array $param,$order=['id'=>'ASC']) {
        $this->setData();
        $data=$this->tableGateway->select(function (Select $select) use ($param,$order) {
            $select->where($param);
            $select->order($order);
        });
        if($data->count()):
            $this->data->setResult(true);
            $this->data->setData($data);
            return $this->data;
        endif;
        $this->data->setClass(self::INFO);
        $this->data->setError("NEMHUM RESULTADO FOI ENCOTADO PARA A SUA PESQUISA");
        return $this->data;
    }

    /**
     * Consulta registro passnaddo um array com um ou mais parametro(s)
     * @param array $param
     * @return type um object table bd
     */
    public function findOneBy(array $param, $object=true) {

        $this->setData();
        $data = $this->tableGateway->select($param);
        if($data->count()):
            $this->data->setResult(true);
            if($object):
                $this->data->setData($data->current());
            else:
                $this->data->setData($data->current()->toArray());
            endif;
        return $this->data;
        endif;
        $this->data->setClass(self::INFO);
        $this->data->setError("NEMHUM RESULTADO FOI ENCOTADO PARA A SUA PESQUISA");
        return $this->data;
    }

    /**
     * Inserir um registro passando uma model como paramentro
     * @param AbstractModel $set
     * @return bool|null
     */
    public function insert(AbstractModel $set)
    {
        $this->setData();
        try {
            if(empty($set->getCodigo())){
                $set->setCodigo(md5(date('YmdHis')));
            }

            if ($this->tableGateway->insert($set->toArray())):
                $this->find($this->tableGateway->getLastInsertValue(),false);
                $this->data->setLastInsert($this->data->getData());
                $this->data->setError("O REGISTRO [ <b>{$set->getTitle()}</b> ] FOI SALVO COM SUCESSO!");
                $this->data->setResult(TRUE);
                $this->data->setClass(self::SUCCESS);
                return $this->data;
            endif;
            $this->data->setError("Nao Foi Possivel Finalizar a Operação!");
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        } catch (InvalidQueryException $exc) {
            $this->data->setError(sprintf("ERROR: %s - %s", $exc->getCode(), $exc->getMessage()));
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        }
        return $this->data;


    }

    /**
     * Atualiza um registro passando uma model como paramentro
     * @param AbstractModel $set
     * @param null $where Usado caso queira usar um parametro diferente do id
     * @return bool
     */
    public function update(AbstractModel $set, $where = null)
    {
        $this->setData();
        $result=false;
        try {
            $oldData = $this->find($set->getId());
            if ($oldData) {
                if($where):
                    $result = $this->tableGateway->update($set->toArray(), [$where]);
                else:
                    $result = $this->tableGateway->update($set->toArray(), ['id' => $set->getId()]);
                endif;

                if ($result) {
                    $this->find($set->getId(),false);
                    $this->data->setError("O REGISTRO [ <b>{$set->getTitle()}</b> ] FOI ATUALIZADO COM SUCESSO!");
                    $this->data->setLastInsert($this->data->getData());
                    $this->data->setClass(self::SUCCESS);
                    $this->data->setResult(TRUE);
                } else {
                    $this->data->setResult(FALSE);
                    $this->data->setClass(self::ERROR);
                    $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, NENHUMA ALTERAÇÃO FOI DETECTADA NO REGISTRO [ <b>{$set->getTitle()}</b> ]!");
                }
                return $this->data;
            }
            $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, POR QUE NENHUM REGISTRO CORRESPONDENTE FOI ENCONTRADO!!");
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        } catch (InvalidQueryException $exc) {
            $this->data->setError(sprintf("ERROR: %s - %s", $exc->getCode(), $exc->getMessage()));
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
        }
        return $this->data;

    }

    /**
     * Excluir um registro do banco passando uma comdição array ou um id como parametro
     * @param $where
     * @return bool
     */
    public function delete($where)
    {
        $this->setData();
         try {
            $filter=new Digits();
            if($filter->isValid($where)):
                $result = $this->tableGateway->delete(['id' =>$where]);
            else:
                $result = $this->tableGateway->delete($where);
            endif;
               if ($result) {
                   $this->data->setResult(TRUE);
                   $this->data->setError("O REGISTRO FOI EXCLUIDO COM SUCESSO!");
                   $this->data->setClass(self::SUCCESS);
                    $this->data->setLastInsert(TRUE);
                    return $this->data;
                }

            $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, POR QUE NENHUM REGISTRO CORRESPONDENTE FOI ENCONTRADO!!");
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
            return $this->data;
        } catch (InvalidQueryException $exc) {
            $this->data->setError(sprintf("ERROR: %s - %s", $exc->getCode(), $exc->getMessage()));
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
            return $this->data;
        }
    }
    //    FUNÇÕES EXTRAS
    public function getMax($id) {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(array('maxId' => new Expression("MAX({$id})")));
        $query = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $rowset = $query->execute();
        $row = $rowset->current();
        if (!$row) {
            $row['maxId'] = 0;
        }
        return $row['maxId'] + 1;
    }

    public function getCount($id="id",$where=[]) {
        $select = $this->tableGateway->getSql()->select($where);
        $select->columns(array('qtd' => new Expression("COUNT({$id})")));
        $query = $this->tableGateway->getSql()->prepareStatementForSqlObject($select);
        $rowset = $query->execute();
        $row = $rowset->current();
        if (!$row) {
            $row['maxId'] = 0;
        }
        return $row['maxId'] + 1;
    }

    /**
     * @return AbstractModel
     */
    public function getData()
    {

        return $this->data;
    }

    /**
     * @return $this
     * @internal param Result $data
     */
    public function setData()
    {
        $this->data=new Result();
        $this->data->setTable($this->getTable());
        return $this;
    }





}