<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Portal\Model\Posts;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Posts extends AbstractModel
{

    protected $catid = null;

    protected $title = null;

    protected $url = null;

    protected $post_type = null;

    protected $post_views = '0';

    protected $images = null;

    protected $created_by = null;

    /**
     * get catid
     *
     * @return int
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
     * get url
     *
     * @return varchar
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * get post_type
     *
     * @return varchar
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * get post_views
     *
     * @return decimal
     */
    public function getPostViews()
    {
        return $this->post_views;
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
     * get created_by
     *
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * set catid
     *
     * @return int
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
     * set post_type
     *
     * @return varchar
     */
    public function setPostType($post_type = null)
    {
        $this->post_type=$post_type;
        return $this;
    }

    /**
     * set post_views
     *
     * @return decimal
     */
    public function setPostViews($post_views = '0')
    {
        $this->post_views=$post_views;
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
     * set created_by
     *
     * @return int
     */
    public function setCreatedBy($created_by = null)
    {
        $this->created_by=$created_by;
        return $this;
    }


}

