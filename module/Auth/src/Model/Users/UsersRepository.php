<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:19
 */

namespace Auth\Model\Users;


use Base\Model\AbstractRepository;
use Zend\Db\TableGateway\TableGateway;
use Zend\Debug\Debug;

class UsersRepository extends AbstractRepository{

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