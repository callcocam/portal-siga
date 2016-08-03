<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 27/07/2016
 * Time: 17:07
 */

namespace Admin\Form;


use Base\Form\AbstractForm;
use Base\Services\Client;
use Interop\Container\ContainerInterface;

class IssusersForm extends AbstractForm {

    public function __construct(ContainerInterface $container, $name, $options = [])
    {
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
        parent::__construct($container, $name);
        $this->setAttributes(['action' => 'users', 'class' => 'form-geral Manager  form-horizontal form-label-left']);


        $this->add([
            'type' => 'text',
            'name' => 'title',
            'options' => [
                'label' => 'Nome Completo'
            ],
            'attributes' => [
                'id' => 'title',
                'class' => 'form-control',
                'placeholder' => 'Nome Completo',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'cep',
            'options' => [
                'label' => 'FILD_CEP_LABEL'
            ],
            'attributes' => [
                'id' => 'cep',
                'class' => 'form-control',
                'placeholder' => '00000-000',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'cnae',
            'options' => [
                'label' => 'FILD_CNAE_LABEL'
            ],
            'attributes' => [
                'id' => 'cnae',
                'class' => 'form-control',
                'placeholder' => '000',
                'title' => 'CNAE',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'cnpj',
            'options' => [
                'label' => 'FILD_CNPJ_LABEL'
            ],
            'attributes' => [
                'id' => 'cnpj',
                'class' => 'form-control',
                'placeholder' => 'FILD_CNPJ_PLACEHOLDER',
                'title' => 'FILD_CNPJ_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'complemento',
            'options' => [
                'label' => 'FILD_COMPLEMENTO_LABEL'
            ],
            'attributes' => [
                'id' => 'complemento',
                'class' => 'form-control',
                'placeholder' => 'FILD_COMPLEMENTO_PLACEHOLDER',
                'title' => 'FILD_COMPLEMENTO_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'csc',
            'options' => [
                'label' => 'FILD_CSC_LABEL'
            ],
            'attributes' => [
                'id' => 'csc',
                'class' => 'form-control',
                'placeholder' => 'FILD_CSC_PLACEHOLDER',
                'title' => 'FILD_CSC_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

         $this->add([
            'type' => 'text',
            'name' => 'csc_id',
            'options' => [
                'label' => 'FILD_CSC_ID_LABEL'
            ],
            'attributes' => [
                'id' => 'csc_id',
                'class' => 'form-control',
                'placeholder' => 'FILD_CSC_ID_PLACEHOLDER',
                'title' => 'FILD_CSC_ID_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'email',
            'options' => [
                'label' => 'FILD_EMAIL_LABEL'
            ],
            'attributes' => [
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'FILD_EMAIL_PLACEHOLDER',
                'title' => 'FILD_EMAIL_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'fantasia',
            'options' => [
                'label' => 'FILD_FANTASIA_LABEL'
            ],
            'attributes' => [
                'id' => 'fantasia',
                'class' => 'form-control',
                'placeholder' => 'FILD_FANTASIA_PLACEHOLDER',
                'title' => 'FILD_FANTASIA_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'fromname',
            'options' => [
                'label' => 'FILD_FROMNOME_LABEL'
            ],
            'attributes' => [
                'id' => 'fromname',
                'class' => 'form-control',
                'placeholder' => 'FILD_FROMNOME_PLACEHOLDER',
                'title' => 'FILD_FROMNOME_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'ibpt',
            'options' => [
                'label' => 'FILD_IBPT_LABEL'
            ],
            'attributes' => [
                'id' => 'ibpt',
                'class' => 'form-control',
                'placeholder' => 'FILD_IBPT_PLACEHOLDER',
                'title' => 'FILD_IBPT_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'ie',
            'options' => [
                'label' => 'FILD_IE_LABEL'
            ],
            'attributes' => [
                'id' => 'ie',
                'class' => 'form-control',
                'placeholder' => 'FILD_IE_PLACEHOLDER',
                'title' => 'FILD_IE_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'im',
            'options' => [
                'label' => 'FILD_IM_LABEL'
            ],
            'attributes' => [
                'id' => 'im',
                'class' => 'form-control',
                'placeholder' => 'FILD_IM_PLACEHOLDER',
                'title' => 'FILD_IM_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'hidden',
            'name' => 'images',
            'attributes' => [
                'id' => 'images',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);
         $this->add([
            'type' => 'text',
            'name' => 'logradouro',
            'options' => [
                'label' => 'FILD_LOGRADOURO_LABEL'
            ],
            'attributes' => [
                'id' => 'logradouro',
                'class' => 'form-control',
                'placeholder' => 'FILD_LOGRADOURO_PLACEHOLDER',
                'title' => 'FILD_LOGRADOURO_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'select',
            'name' => 'municipio',
            'options' => [
                'label' => 'FILD_MUNICIPIO_LABEL'
            ],
            'attributes' => [
                'id' => 'municipio',
                'class' => 'form-control',
                'placeholder' => 'FILD_MUNICIPIO_PLACEHOLDER',
                'title' => 'FILD_MUNICIPIO_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'numero',
            'options' => [
                'label' => 'FILD_NUMERO_LABEL'
            ],
            'attributes' => [
                'id' => 'numero',
                'class' => 'form-control',
                'placeholder' => 'FILD_NUMERO_PLACEHOLDER',
                'title' => 'FILD_NUMERO_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'pass',
            'options' => [
                'label' => 'FILD_PASS_LABEL'
            ],
            'attributes' => [
                'id' => 'pass',
                'class' => 'form-control',
                'placeholder' => 'FILD_PASS_PLACEHOLDER',
                'title' => 'FILD_PASS_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'port',
            'options' => [
                'label' => 'FILD_PORT_LABEL'
            ],
            'attributes' => [
                'id' => 'port',
                'class' => 'form-control',
                'placeholder' => 'FILD_PORT_PLACEHOLDER',
                'title' => 'FILD_PORT_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'replyto',
            'options' => [
                'label' => 'FILD_REPLYTO_LABEL'
            ],
            'attributes' => [
                'id' => 'replyto',
                'class' => 'form-control',
                'placeholder' => 'FILD_REPLYTO_PLACEHOLDER',
                'title' => 'FILD_REPLYTO_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $this->add([
            'type' => 'text',
            'name' => 'smtp',
            'options' => [
                'label' => 'FILD_SMTP_LABEL'
            ],
            'attributes' => [
                'id' => 'smtp',
                'class' => 'form-control',
                'placeholder' => 'FILD_SMTP_PLACEHOLDER',
                'title' => 'FILD_SMTP_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

         $this->add([
            'type' => 'text',
            'name' => 'ssl',
            'options' => [
                'label' => 'FILD_SSL_LABEL'
            ],
            'attributes' => [
                'id' => 'ssl',
                'class' => 'form-control',
                'placeholder' => 'FILD_SSL_PLACEHOLDER',
                'title' => 'FILD_SSL_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

         $this->add([
            'type' => 'select',
            'name' => 'uf',
            'options' => [
                'label' => 'FILD_UF_LABEL'
            ],
            'attributes' => [
                'id' => 'uf',
                'class' => 'form-control',
                'placeholder' => 'FILD_UF_PLACEHOLDER',
                'title' => 'FILD_UF_DESC',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ]);

        $arrayUf = array(
            'AC'=>'AC',
            'AL'=>'AL',
            'AM'=>'AM',
            'AP'=>'AP',
            'BA'=>'BA',
            'CE'=>'CE',
            'DF'=>'DF',
            'ES'=>'ES',
            'GO'=>'GO',
            'MA'=>'MA',
            'MG'=>'MG',
            'MS'=>'MS',
            'MT'=>'MT',
            'PA'=>'PA',
            'PB'=>'PB',
            'PE'=>'PE',
            'PI'=>'PI',
            'PR'=>'PR',
            'RJ'=>'RJ',
            'RN'=>'RN',
            'RO'=>'RO',
            'RR'=>'RR',
            'RS'=>'RS',
            'SC'=>'SC',
            'SE'=>'SE',
            'SP'=>'SP',
            'TO'=>'TO'
        );
                /**
                 * @var $client ClientHttp
                 */
                $client = $this->container->get(Client::class);

                $client->setUri(sprintf("%s/%s",$this->config->serverHost,'cidades'));
                $response = $client->send();

                $arraycidades=[];
                if ($response->isSuccess()) {
                    $data=json_decode($response->getBody(),true);

                    foreach($data['data'] as $o){
                        $arraycidades[$o['id']]=$o['title'];
                     }

                }
                $this->get('municipio')->setOptions(['value_options' => $arraycidades]);
                $this->get('uf')->setOptions(['value_options' => $arrayUf]);




    }
} 