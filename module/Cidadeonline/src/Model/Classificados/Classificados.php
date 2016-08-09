<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Model\Classificados;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Classificados extends AbstractModel
{

    protected $catid = null;

    protected $title = null;

    protected $phone = null;

    protected $email = null;

    protected $facebook = null;

    protected $site = null;

    protected $url = null;

    protected $images = null;

    protected $created_by;

    protected $classifcados_views = null;

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
     * get title
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->title;
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
     * get email
     *
     * @return varchar
     */
    public function getEmail()
    {
        return $this->email;
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
     * get site
     *
     * @return varchar
     */
    public function getSite()
    {
        return $this->site;
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
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }


    /**
     * get classifcados_views
     *
     * @return decimal
     */
    public function getClassifcadosViews()
    {
        return $this->classifcados_views;
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
     * @param mixed $created_by
     */
    public function setCreatedBy($created_by)
    {
        $this->created_by = $created_by;
    }


    /**
     * set classifcados_views
     *
     * @return decimal
     */
    public function setClassifcadosViews($classifcados_views = null)
    {
        $this->classifcados_views=$classifcados_views;
        return $this;
    }


}

