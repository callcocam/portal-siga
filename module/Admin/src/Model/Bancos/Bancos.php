<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Model\Bancos;

use Base\Model\AbstractModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class Bancos extends AbstractModel
{

    protected $title = null;

    protected $agencia = null;

    protected $carteira = null;

    protected $conta = null;

    protected $convenio = null;

    protected $sequencial = null;

    protected $conta_dv = null;

    protected $agencia_dv = null;

    protected $descricao_demonstrativo = null;

    protected $instrucoes = null;

    protected $images = null;

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
     * get agencia
     *
     * @return varchar
     */
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * get carteira
     *
     * @return varchar
     */
    public function getCarteira()
    {
        return $this->carteira;
    }

    /**
     * get conta
     *
     * @return varchar
     */
    public function getConta()
    {
        return $this->conta;
    }

    /**
     * get convenio
     *
     * @return varchar
     */
    public function getConvenio()
    {
        return $this->convenio;
    }

    /**
     * get sequencial
     *
     * @return varchar
     */
    public function getSequencial()
    {
        return $this->sequencial;
    }

    /**
     * get conta_dv
     *
     * @return varchar
     */
    public function getContaDv()
    {
        return $this->conta_dv;
    }

    /**
     * get agencia_dv
     *
     * @return varchar
     */
    public function getAgenciaDv()
    {
        return $this->agencia_dv;
    }

    /**
     * get descricao_demonstrativo
     *
     * @return varchar
     */
    public function getDescricaoDemonstrativo()
    {
        return $this->descricao_demonstrativo;
    }

    /**
     * get instrucoes
     *
     * @return varchar
     */
    public function getInstrucoes()
    {
        return $this->instrucoes;
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
     * set agencia
     *
     * @return varchar
     */
    public function setAgencia($agencia = null)
    {
        $this->agencia=$agencia;
        return $this;
    }

    /**
     * set carteira
     *
     * @return varchar
     */
    public function setCarteira($carteira = null)
    {
        $this->carteira=$carteira;
        return $this;
    }

    /**
     * set conta
     *
     * @return varchar
     */
    public function setConta($conta = null)
    {
        $this->conta=$conta;
        return $this;
    }

    /**
     * set convenio
     *
     * @return varchar
     */
    public function setConvenio($convenio = null)
    {
        $this->convenio=$convenio;
        return $this;
    }

    /**
     * set sequencial
     *
     * @return varchar
     */
    public function setSequencial($sequencial = null)
    {
        $this->sequencial=$sequencial;
        return $this;
    }

    /**
     * set conta_dv
     *
     * @return varchar
     */
    public function setContaDv($conta_dv = null)
    {
        $this->conta_dv=$conta_dv;
        return $this;
    }

    /**
     * set agencia_dv
     *
     * @return varchar
     */
    public function setAgenciaDv($agencia_dv = null)
    {
        $this->agencia_dv=$agencia_dv;
        return $this;
    }

    /**
     * set descricao_demonstrativo
     *
     * @return varchar
     */
    public function setDescricaoDemonstrativo($descricao_demonstrativo = null)
    {
        $this->descricao_demonstrativo=$descricao_demonstrativo;
        return $this;
    }

    /**
     * set instrucoes
     *
     * @return varchar
     */
    public function setInstrucoes($instrucoes = null)
    {
        $this->instrucoes=$instrucoes;
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


}

