<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Model\Empresas;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Empresas extends AbstractModel
{

    protected $title = null;

    protected $email = null;

    protected $url = null;

    protected $images = null;

    protected $ramo = null;

    protected $site = null;

    protected $facebook = null;

    protected $endereco = null;

    protected $uf = null;

    protected $cidade = null;

    protected $catid = null;

    protected $password = null;

    protected $empresa_views = null;

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
     * get email
     *
     * @return varchar
     */
    public function getEmail()
    {
        return $this->email;
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
     * get images
     *
     * @return varchar
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * get ramo
     *
     * @return varchar
     */
    public function getRamo()
    {
        return $this->ramo;
    }

    /**
     * get site
     *
     * @return varchar
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * get facebook
     *
     * @return varchar
     */
    public function getFacebook()
    {
        return $this->facebook;
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
     * get uf
     *
     * @return int
     */
    public function getUf()
    {
        return $this->uf;
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
     * get catid
     *
     * @return varchar
     */
    public function getCatid()
    {
        return $this->catid;
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
     * get empresa_views
     *
     * @return decimal
     */
    public function getEmpresaViews()
    {
        return $this->empresa_views;
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
     * set images
     *
     * @return varchar
     */
    public function setImages($images = null)
    {
        $this->images=$images;
        return $this;
    }

    /**
     * set ramo
     *
     * @return varchar
     */
    public function setRamo($ramo = null)
    {
        $this->ramo=$ramo;
        return $this;
    }

    /**
     * set site
     *
     * @return varchar
     */
    public function setSite($site = null)
    {
        $this->site=$site;
        return $this;
    }

    /**
     * set facebook
     *
     * @return varchar
     */
    public function setFacebook($facebook = null)
    {
        $this->facebook=$facebook;
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
     * set uf
     *
     * @return int
     */
    public function setUf($uf = null)
    {
        $this->uf=$uf;
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
     * set catid
     *
     * @return varchar
     */
    public function setCatid($catid = null)
    {
        $this->catid=$catid;
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
     * set empresa_views
     *
     * @return decimal
     */
    public function setEmpresaViews($empresa_views = null)
    {
        $this->empresa_views=$empresa_views;
        return $this;
    }


}

