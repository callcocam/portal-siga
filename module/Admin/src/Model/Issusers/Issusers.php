<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 27/07/2016
 * Time: 14:09
 */

namespace Admin\Model\Issusers;


use Base\Model\AbstractModel;

class Issusers extends AbstractModel{

    protected $fantasia;
    protected $title;
    protected $logradouro;
    protected $numero;
    protected $complemento;
    protected $municipio;
    protected $uf;
    protected $cep;
    protected $images;
    protected $cnpj;
    protected $ie;
    protected $im;
    protected $cnae;
    protected $csc;
    protected $csc_id;
    protected $ibpt;
    protected $email;
    protected $pass;
    protected $smtp;
    protected $port;
    protected $ssl;
    protected $fromname;
    protected $replyto;

    /**
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * @param mixed $cep
     */
    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return mixed
     */
    public function getCnae()
    {
        return $this->cnae;
    }

    /**
     * @param mixed $cnae
     */
    public function setCnae($cnae)
    {
        $this->cnae = $cnae;
    }

    /**
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    /**
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * @param mixed $complemento
     */
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    /**
     * @return mixed
     */
    public function getCsc()
    {
        return $this->csc;
    }

    /**
     * @param mixed $csc
     */
    public function setCsc($csc)
    {
        $this->csc = $csc;
    }

    /**
     * @return mixed
     */
    public function getCscId()
    {
        return $this->csc_id;
    }

    /**
     * @param mixed $csc_id
     */
    public function setCscId($csc_id)
    {
        $this->csc_id = $csc_id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getFantasia()
    {
        return $this->fantasia;
    }

    /**
     * @param mixed $fantasia
     */
    public function setFantasia($fantasia)
    {
        $this->fantasia = $fantasia;
    }

    /**
     * @return mixed
     */
    public function getFromname()
    {
        return $this->fromname;
    }

    /**
     * @param mixed $fromname
     */
    public function setFromname($fromname)
    {
        $this->fromname = $fromname;
    }

    /**
     * @return mixed
     */
    public function getIbpt()
    {
        return $this->ibpt;
    }

    /**
     * @param mixed $ibpt
     */
    public function setIbpt($ibpt)
    {
        $this->ibpt = $ibpt;
    }

    /**
     * @return mixed
     */
    public function getIe()
    {
        return $this->ie;
    }

    /**
     * @param mixed $ie
     */
    public function setIe($ie)
    {
        $this->ie = $ie;
    }

    /**
     * @return mixed
     */
    public function getIm()
    {
        return $this->im;
    }

    /**
     * @param mixed $im
     */
    public function setIm($im)
    {
        $this->im = $im;
    }

    /**
     * @return mixed
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * @param mixed $logradouro
     */
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param mixed $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getReplyto()
    {
        return $this->replyto;
    }

    /**
     * @param mixed $replyto
     */
    public function setReplyto($replyto)
    {
        $this->replyto = $replyto;
    }

    /**
     * @return mixed
     */
    public function getSmtp()
    {
        return $this->smtp;
    }

    /**
     * @param mixed $smtp
     */
    public function setSmtp($smtp)
    {
        $this->smtp = $smtp;
    }

    /**
     * @return mixed
     */
    public function getSsl()
    {
        return $this->ssl;
    }

    /**
     * @param mixed $ssl
     */
    public function setSsl($ssl)
    {
        $this->ssl = $ssl;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * @param mixed $uf
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    }



} 