<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Form;

/**
 * Description of BuscaForm
 *
 * @author Call
 */
class BuscaForm extends \Zend\Form\Form {

    /**
     * Initialize  elements
     */
    public function __construct() {
        // Configurações iniciais do Form
        parent::__construct("Busca");
        $this->setAttribute("method", "post");
        $this->setAttribute("class", "navbar-form navbar-right");
        $this->setAttribute("role", "search");



        // informações da coluna state:
        $this->add(
                array(
                    'type' => 'Select',
                    'name' => 'state',
                    'options' => array(
                       'value_options'=>array('-1'=>'Tudo','0'=>'Publicado','1'=>'Arquivado')
                    ),
                    'attributes' => array(
                        'id' => 'state',
                        'class' => 'form-control',
                        'placeholder' => 'FILD_STATE_PLACEHOLDER',
                        'title' => 'FILD_STATE_DESC',
                    ),
                )
        );


        // informações da coluna title:
        $this->add(
                array(
                    'type' => 'text',
                    'name' => 'busca',
                    'options' => array(
                        'label' => '- : -',
                    ),
                    'attributes' => array(
                        'id' => 'busca',
                        'class' => 'form-control',
                        'placeholder' => 'FILD_BUSCA_PLACEHOLDER',
                        'title' => 'FILD_BUSCA_DESC',
                    ),
                )
        );
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'BUSCAR',
                'id' => 'submit',
                'class' => 'btn btn-default'
            ),
        ));
    }

}
