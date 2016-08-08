<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Model\Comentarios;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Comentarios extends AbstractModel
{

    protected $tipo = null;

    protected $parent = '0';

    protected $parent_id = null;

    protected $title = null;

    protected $nota=1;

    protected $created_by = null;

    /**
     * get tipo
     *
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * get parent
     *
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * get parent_id
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parent_id;
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
     * @return int
     */
    public function getNota()
    {
        return $this->nota;
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
     * set tipo
     *
     * @return int
     */
    public function setTipo($tipo = null)
    {
        $this->tipo=$tipo;
        return $this;
    }

    /**
     * set parent
     *
     * @return int
     */
    public function setParent($parent = '0')
    {
        $this->parent=$parent;
        return $this;
    }

    /**
     * set parent_id
     *
     * @return int
     */
    public function setParentId($parent_id = null)
    {
        $this->parent_id=$parent_id;
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
     * @param int $nota
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
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

