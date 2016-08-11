<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Cidadeonline\Form;

use Auth\Model\Roles\RolesRepository;
use Base\Form\AbstractForm;
use Base\Services\Client;
use Interop\Container\ContainerInterface;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ClientesForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @param ContainerInterface $container
     * @param string $name
     * @param array $options
     * @return \Cidadeonline\Form\ClientesForm
     */
    public function __construct(ContainerInterface $container, $name = 'Clientes', array $options = array())
    {
        // Configurações iniciais do Form
        $this->container = $container;
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setAccess([]);
        $this->setCreated([]);
        $this->setEmpresa([]);
        $this->setModified([]);
        $this->setSave([]);
        $this->setCsrf([]);
        $this->setState([]);
        $this->setDescription([]);
        $this->getAuthservice();
        parent::__construct($container, $name, $options);
        $this->setAttributes(["action" => "users", "class" => "form-geral Manager form-horizontal"]);
        //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'title',
                'options' => [
                    'label' => 'FILD_TITLE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'title',
                    'class' => 'form-control',
                    'title' => 'FILD_TITLE_DESC',
                    'placeholder' => 'FILD_TITLE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna url ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'url',
                'options' => [
                    'label' => 'FILD_URL_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'url',
                    'class' => 'form-control',
                    'title' => 'FILD_URL_DESC',
                    'placeholder' => 'FILD_URL_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    'readonly' => true,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna cnpj ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'cnpj',
                'options' => [
                    'label' => 'FILD_CNPJ_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'cnpj',
                    'class' => 'form-control',
                    'title' => 'FILD_CNPJ_DESC',
                    'placeholder' => 'FILD_CNPJ_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna email ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'email',
                'options' => [
                    'label' => 'FILD_EMAIL_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'email',
                    'class' => 'form-control',
                    'title' => 'FILD_EMAIL_DESC',
                    'placeholder' => 'FILD_EMAIL_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna phone ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'phone',
                'options' => [
                    'label' => 'FILD_PHONE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'phone',
                    'class' => 'form-control',
                    'title' => 'FILD_PHONE_DESC',
                    'placeholder' => 'FILD_PHONE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna cidade ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
                'name' => 'cidade',
                'options' => [
                    'label' => 'FILD_CIDADE_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'cidade',
                    'class' => 'form-control',
                    'title' => 'FILD_CIDADE_DESC',
                    'placeholder' => 'FILD_CIDADE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna cep ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'cep',
                'options' => [
                    'label' => 'FILD_CEP_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'cep',
                    'class' => 'form-control',
                    'title' => 'FILD_CEP_DESC',
                    'placeholder' => 'FILD_CEP_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna bairro ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'bairro',
                'options' => [
                    'label' => 'FILD_BAIRRO_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'bairro',
                    'class' => 'form-control',
                    'title' => 'FILD_BAIRRO_DESC',
                    'placeholder' => 'FILD_BAIRRO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna endereco ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'endereco',
                'options' => [
                    'label' => 'FILD_ENDERECO_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'endereco',
                    'class' => 'form-control',
                    'title' => 'FILD_ENDERECO_DESC',
                    'placeholder' => 'FILD_ENDERECO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna images ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'images',
                'options' => [
                    'label' => 'FILD_IMAGES_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'images',
                    'class' => 'form-control',
                    'title' => 'FILD_IMAGES_DESC',
                    'placeholder' => 'FILD_IMAGES_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'images',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna password ##############################################:
        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'password',
                'options' => [
                    //  'label' => 'FILD_PASSWORD_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'password',
                    //'class' =>'form-control',
                    // 'title' => 'FILD_PASSWORD_DESC',
                    // 'placeholder' => 'FILD_PASSWORD_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna usr_registration_token ##############################################:
        $this->add([
                'type' => 'hidden',//hidden, select, radio, checkbox, textarea
                'name' => 'usr_registration_token',
                'options' => [
                    // 'label' => 'FILD_USR_REGISTRATION_TOKEN_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'usr_registration_token',
                    //'class' =>'form-control',
                    //'title' => 'FILD_USR_REGISTRATION_TOKEN_DESC',
                    //'placeholder' => 'FILD_USR_REGISTRATION_TOKEN_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna role_id ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
                'name' => 'role_id',
                'options' => [
                    'label' => 'FILD_ROLE_ID_LABEL',
                    //'value_options'      =>[],
                    //"disable_inarray_validator" => true,
                ],
                'attributes' => [
                    'id' => 'role_id',
                    'class' => 'form-control',
                    'title' => 'FILD_ROLE_ID_DESC',
                    'placeholder' => 'FILD_ROLE_ID_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );

        if ($this->has('role_id')):
            if ($this->get('role_id')->getAttribute('type') == "select"):
                $roles = $this->container->get(RolesRepository::class);
                $this->get('role_id')->setOptions(['value_options' => $roles->getRoleId()]);
            else:
                $this->get('role_id')->setValue('5');
            endif;
        endif;

        if ($this->has('cidade')):
            if ($this->get('cidade')->getAttribute('type') == "select"):
                /**
                 * @var $client ClientHttp
                 */
                $client = $this->container->get(Client::class);

                $client->setUri(sprintf("%s/%s", $this->config->serverHost, 'cidades'));
                $response = $client->send();

                if ($response->isSuccess()) {
                    $data = json_decode($response->getBody(), true);
                    $arraycidades = [];
                    foreach ($data['data'] as $o) {
                        $arraycidades[$o['id']] = $o['title'];
                    }

                }
                $this->get('cidade')->setOptions(['value_options' => $arraycidades]);
            else:
                $this->get('cidade')->setValue('1');
            endif;
        endif;


    }


}