<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:19
 */

namespace Auth\Model\Users;


use Auth\Storage\IdentityManager;
use Base\Model\AbstractModel;
use Base\Model\AbstractRepository;
use Base\Model\Check;
use Zend\Db\TableGateway\TableGateway;


class UsersRepository extends AbstractRepository{

    public $container;
    /**
     * @param TableGateway $tableGateway
     */
    function __construct(TableGateway $tableGateway)
    {
        // TODO: Implement __construct() method.
        $this->tableGateway = $tableGateway;
    }
    public function getUserByToken($token) {
        return $this->findOneBy(array('usr_registration_token' => $token));
    }

    public function insert(AbstractModel $model){
        $model->setUrl(Check::Name($model->getTitle()));
        $exist=$this->findBy(['url'=>$model->getUrl()]);
        if($exist->getResult())
        {
            $url=sprintf("%s-%s",$model->getUrl(),date('YmdHis'));
            $model->setUrl($url);
        }
        $result=parent::insert($model);
        if($result->getResult())
        {
            /**
             * @var $user IdentityManager
             */
            $user=$this->container->get(IdentityManager::class);
            $user->login(
                $model->getEmail(),
                $model->getPassword(),
                $this->container->get('request')->getServer('HTTP_USER_AGENT'),
                $this->container->get('request')->getServer('REMOTE_ADDR'));
        }
        return $result;
    }

    public function update(AbstractModel $set, $where = null)
    {
        $this->container->get('request')->getServer('HTTP_USER_AGENT');
        if(empty($set->getUrl())){
            $set->setUrl(Check::Name($set->getTitle()));
            $exist=$this->findBy(['url'=>$set->getUrl()]);
            if($exist->getResult())
            {
                $url=sprintf("%s-%s",$set->getUrl(),date('YmdHis'));
                $set->setUrl($url);
            }
        }
        $result=parent::update($set, $where);
        if($result->getResult())
        {
            /**
             * @var $user IdentityManager
             */
            $user=$this->container->get(IdentityManager::class);
            $user->login(
                $set->getEmail(),
                $set->getPassword(),
                $this->container->get('request')->getServer('HTTP_USER_AGENT'),
                $this->container->get('request')->getServer('REMOTE_ADDR'));
        }
        return $result;

    }

    public function activateUser($usr_id) {
        $data['state'] = 0;
        $data['usr_registration_token'] = 'ATIVADO';
        return $this->tableGateway->update($data, array('id' => (int) $usr_id));
    }

    public function getUserByEmail($usr_email) {
        return $this->findOneBy(array('email' => $usr_email));
    }

    public function changePassword($usr_id, $password) {
        $this->setData();
        $data['password'] = $password;
        $result=$this->tableGateway->update($data, array('id' => (int) $usr_id));
        if ($result) {
            $this->find($usr_id,false);
            $this->data->setError("O SENHA FOI ALTERADA COM SUCESSO!");
            $this->data->setLastInsert($this->data->getData());
            $this->data->setClass(self::SUCCESS);
            $this->data->setResult(TRUE);
        } else {
            $this->data->setResult(FALSE);
            $this->data->setClass(self::ERROR);
            $this->data->setError("NÃO FOI POSSIVEL CONCLUIR A SUA SOLISITAÇÃO, NENHUMA ALTERAÇÃO FOI DETECTADA NO REGISTRO!");
        }
        return $this->data;

    }
}