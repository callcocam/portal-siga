<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Mail\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class MailForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Mail\Form\MailForm
     */
    public function __construct(ContainerInterface $container, $name = 'Mail', array $options = array())
    {
        // Configurações iniciais do Form
        $this->container = $container;
        $this->setDescription([]);
        $this->setCsrf([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);

          //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'title',
                'options' => [
                    'label' => 'FILD_TITLE_CONTATO_LABEL',
                 ],
                'attributes' => [
                    'id'=>'title',
                    'class' =>'span6',
                    'title' => 'FILD_TITLE_CONTATO_DESC',
                    'placeholder' => 'FILD_TITLE_CONTATO_PLACEHOLDER',
                    'requerid' => true,
                ],
            ]
        );

        //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'email',//hidden, select, radio, checkbox, textarea
                'name' => 'email',
                'options' => [
                     'label' => 'FILD_EMAIL_CONTATO_LABEL',
                    ],
                'attributes' => [
                    'id'=>'search',
                    'class' =>'span7',
                    'title' => 'FILD_TITLE_CONTATO_DESC',
                    'placeholder' => 'FILD_EMAIL_CONTATO_PLACEHOLDER',
                     'requerid' => true,
                ],
            ]
        );

        //############################################ informações da coluna subject ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'subject',
                'options' => [
                'label' => 'FILD_TITLE_LABEL',
                 ],
                'attributes' => [
                    'id'=>'subject',
                    'class' =>'span5',
                    'title' => 'FILD_SUBJECT_DESC',
                    'placeholder' => 'FILD_SUBJECT_PLACEHOLDER',

                ],
            ]
        );


    }


}

