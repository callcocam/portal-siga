<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Model\Clientes;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Clientes extends AbstractModel
{

    protected $title = null;

    protected $url = null;

    protected $cnpj = null;

    protected $email = null;

    protected $phone = null;

    protected $cidade = null;

    protected $cep = null;

    protected $bairro = null;

    protected $endereco = null;

    protected $images = 'users_default.jpg';

    protected $password = null;

    protected $usr_registration_token = null;

    protected $role_id = '5';

    /**
     * get title
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * get url
     *
     * @return varchar
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * get cnpj
     *
     * @return varchar
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * get email
     *
     * @return varchar
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * get phone
     *
     * @return varchar
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * get cidade
     *
     * @return int
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * get cep
     *
     * @return varchar
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * get bairro
     *
     * @return varchar
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * get endereco
     *
     * @return varchar
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * get images
     *
     * @return varchar
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * get password
     *
     * @return varchar
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * get usr_registration_token
     *
     * @return varchar
     */
    public function getUsrRegistrationToken()
    {
        return $this->usr_registration_token;
    }

    /**
     * get role_id
     *
     * @return int
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * set title
     *
     * @return varchar
     */
    public function setTitle($title = null)
    {
        $this->title=$title;
        return $this;
    }

    /**
     * set url
     *
     * @return varchar
     */
    public function setUrl($url = null)
    {
        $this->url=$url;
        return $this;
    }

    /**
     * set cnpj
     *
     * @return varchar
     */
    public function setCnpj($cnpj = null)
    {
        $this->cnpj=$cnpj;
        return $this;
    }

    /**
     * set email
     *
     * @return varchar
     */
    public function setEmail($email = null)
    {
        $this->email=$email;
        return $this;
    }

    /**
     * set phone
     *
     * @return varchar
     */
    public function setPhone($phone = null)
    {
        $this->phone=$phone;
        return $this;
    }

    /**
     * set cidade
     *
     * @return int
     */
    public function setCidade($cidade = null)
    {
        $this->cidade=$cidade;
        return $this;
    }

    /**
     * set cep
     *
     * @return varchar
     */
    public function setCep($cep = null)
    {
        $this->cep=$cep;
        return $this;
    }

    /**
     * set bairro
     *
     * @return varchar
     */
    public function setBairro($bairro = null)
    {
        $this->bairro=$bairro;
        return $this;
    }

    /**
     * set endereco
     *
     * @return varchar
     */
    public function setEndereco($endereco = null)
    {
        $this->endereco=$endereco;
        return $this;
    }

    /**
     * set images
     *
     * @return varchar
     */
    public function setImages($images = 'users_default.jpg')
    {
        $this->images=$images;
        return $this;
    }

    /**
     * set password
     *
     * @return varchar
     */
    public function setPassword($password = null)
    {
        $this->password=$password;
        return $this;
    }

    /**
     * set usr_registration_token
     *
     * @return varchar
     */
    public function setUsrRegistrationToken($usr_registration_token = null)
    {
        $this->usr_registration_token=$usr_registration_token;
        return $this;
    }

    /**
     * set role_id
     *
     * @return int
     */
    public function setRoleId($role_id = '5')
    {
        $this->role_id=$role_id;
        return $this;
    }


}

