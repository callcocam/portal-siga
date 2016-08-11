<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 12:33
 */

namespace Base\Form;


use Admin\Model\Issusers\IssusersRepository;
use Auth\Model\Roles\Roles;
use Auth\Model\Roles\RolesRepository;
use Auth\Storage\IdentityManager;
use Base\Services\Client;
use Base\View\Helper\Form\Custom\Captcha\CustomCaptcha;
use Interop\Container\ContainerInterface;
use Zend\Captcha\Image;
use Zend\Form\Form;

class AbstractForm extends Form{

    protected $container;
    protected $authservice;


    protected $cache;
    protected $companies;
    protected $captchaImage;
    protected $wordLen = 5;
    protected $width = 200;
    protected $height = 100;
    protected $dirdata = './data/fonts/arial.ttf';
    protected $urlcaptcha;
    protected $config;

    protected $id;
    protected $codigo;
    protected $empresa;
    protected $assetid;
    protected $description;
    protected $state;
    protected $access;
    protected $created;
    protected $modified;
    protected $captcha;
    protected $csrf;
    protected $save;
    protected $savecopy;
    public static $STATE = ['0' => "OPTION_PUBLICADO_LABEL", '1' => "OPTION_ARQUIVADO_LABEL", '2' => "OPTION_LIXEIRA_LABEL"];


    public function __construct(ContainerInterface $container,$name, $options = [])
    {
        parent::__construct($name, $options);

        $this->container=$container;
        $this->config=$this->container->get('ZfConfig');
        if(!is_null($this->captcha)){
            $this->add($this->captcha);
        }
        if(!is_null($this->id)) {
            $this->add($this->id);
        }
        if(!is_null($this->codigo)) {
            $this->add($this->codigo);
        }
        if(!is_null($this->empresa)) {
            $this->add($this->empresa);
        }
        if(!is_null($this->assetid)) {
            $this->add($this->assetid);
        }

        if(!is_null($this->access)) {
            $this->add($this->access);
        }
        if(!is_null($this->state)) {
            $this->add($this->state);
        }
        if(!is_null($this->created)) {
            $this->add($this->created);
        }

        if(!is_null($this->modified)) {
            $this->add($this->modified);
        }
        if(!is_null($this->description)) {
            $this->add($this->description);
        }

        if(!is_null($this->csrf)) {
            $this->add($this->csrf);
        }
        if(!is_null($this->savecopy)){
            $this->add($this->savecopy);
        }
        if(!is_null($this->save)) {
            $this->add($this->save);
        }

        if ($this->has('state')):
            if($this->get('state')->getAttribute('type')=="select"):
                $this->get('state')->setOptions(['value_options' => self::$STATE]);
            else:
                $this->get('state')->setValue('1');
            endif;
        endif;

        if ($this->has('access')):
            if($this->get('access')->getAttribute('type')=="select"):
                $roles=$this->container->get(RolesRepository::class);
                $this->get('access')->setOptions(['value_options' => $roles->getRoleId()]);
            else:
                $this->get('access')->setValue(isset($this->authservice->role_id)?$this->authservice->role_id:'1');
            endif;

        endif;



        if ($this->has('empresa')):
            if($this->get('empresa')->getAttribute('type')=="select"):
                $empresas=$this->container->get(IssusersRepository::class);
                $this->get('empresa')->setOptions(['value_options' => $empresas->getEmpresas()]);

            else:
                $this->get('empresa')->setValue(isset($this->authservice->id)?$this->authservice->id:'1');
            endif;
        endif;




        if ($this->has('created')):
            $this->get('created')->setValue(date("d-m-Y"));
        endif;

        if ($this->has('modified')):
            $this->get('modified')->setValue(date("d-m-Y H:i:s"));
        endif;


    }


    /**
     * @return mixed
     */
    public function getAuthservice()
    {
        $this->authservice=$this->container->get(IdentityManager::class)->hasIdentity();
        return $this->authservice;
    }


    /**
     * @param array $id
     */
    public function setId($id)
    {
        $this->id =array_replace([
            'type'=>'hidden',
            'name'=>'id',
            'options'=>[],
            'attributes'=>[
                'id'=>'id',
                'value'=>'AUTOMATICO',
                'data-position' => 'geral',
            ]
        ], $id);
    }

    /**
     * @param array $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = array_replace([
            'type'=>'hidden',
            'name'=>'empresa',
            'options'=>[],
            'attributes'=>[
                'id'=>'empresa',
                'value' => '',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ],$empresa);
    }

    /**
     * @param array $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = array_replace([
            'type'=>'hidden',
            'name'=>'codigo',
            'options'=>[],
            'attributes'=>[
                'id'=>'codigo',
                'value'=>'8',
                'data-position' => 'geral'
            ]
        ],$codigo);
    }

    /**
     * @param array $assetid
     */
    public function setAssetid($assetid)
    {
        $this->assetid = array_replace([
            'type'=>'hidden',
            'name'=>'asset_id',
            'options'=>[],
            'attributes'=>[
                'id'=>'asset_id',
                'id' => 'asset_id',
                'value' =>isset($this->authservice['empresa'])? md5($this->authservice['empresa']):'1',
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ],$assetid);
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = array_replace([
                'type' => 'textarea',
                'name' => 'description',
                'options' => [
                    'label' => 'FILD_DESCRIPTION_LABEL',
                ],
                'attributes' => [
                    'id' => 'description',
                    'title' => 'FILD_DESCRIPTION_DESC',
                    'class' => 'form-control',
                    'placeholder' => 'FILD_DESCRIPTION_PLACEHOLDER',
                    'rows' => '5',
                    'cols' => '20',
                    'data-access' => '3',
                    'data-position' => 'geral',
                ],
            ]
            ,$description);
    }



    /**
     * @param array $access
     */
    public function setAccess($access)
    {
        $this->access = array_replace([
            'type'=>'select',
            'name'=>'access',
            'options'=>[
                'label' => 'FILD_ACCESS_LABEL',
                "disable_inarray_validator" => true,
            ],
            'attributes'=>[
                'id' => 'access',
                'title' => 'FILD_ACCESS_DESC',
                'class' => 'form-control',
                'placeholder' => 'FILD_ACCESS_PLACEHOLDER',
                'data-access' => '3',
                'value'=>'3',
                'data-position' => 'datas',
            ]
        ],$access);
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = array_replace([
            'type'=>'select',
            'name'=>'state',
            'options'=>[
                'label' => 'FILD_STATE_LABEL',
                "disable_inarray_validator" => true,
            ],
            'attributes'=>[
                'id' => 'state',
                'title' => 'FILD_STATE_DESC',
                'class' => 'form-control',
                'placeholder' => 'FILD_STATE_PLACEHOLDER',
                'data-access' => '3',
                'data-position' => 'datas',
            ]
        ],$state);
    }
    /**
     * @param array $created
     */
    public function setCreated($created)
    {
        $this->created = array_replace([
            'type'=>'text',
            'name'=>'created',
            'options'=>['label' => 'FILD_CREATED_LABEL'],
            'attributes'=>[
                'id' => 'created',
                'title' => 'FILD_CREATED_DESC',
                'class' => 'form-control',
                'placeholder' => 'FILD_CREATED_PLACEHOLDER',
                'readonly' => true,
                'data-access' => '3',
                'data-position' => 'datas',
            ]
        ],$created);
    }



    /**
     * @param array $modified
     */
    public function setModified($modified)
    {
        $this->modified = array_replace([
            'type'=>'text',
            'name'=>'modified',
            'options'=>['label' => 'FILD_MODIFIED_LABEL'],
             'attributes'=>[
                'id'=>'modified',
                'title' => 'FILD_MODIFIED_DESC',
                'class' => 'form-control',
                'placeholder' => 'FILD_MODIFIED_PLACEHOLDER',
                'value'=>date("d-m-Y"),
                'data-access' => '3',
                'data-position' => 'datas',
            ]
        ],$modified);
    }


    /**
     * @param mixed $csrf
     */
    public function setCsrf($csrf)
    {
        $this->csrf = array_replace([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'security',
            'options' => [
                'csrf_options' =>[
                    'timeout' => 600
                ]
            ], 'attributes' => [
                'data-access' => '3',
                'data-position' => 'geral',
            ]
        ],$csrf);
    }

    /**
     * @param mixed $captcha
     */
    public function setCaptcha($captcha, $captchaImage)
    {
        $this->captcha = array_replace([
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => [
                'label' => 'Por favor verificar que você é humano.',
                'captcha' => $captchaImage,
            ],
            'attributes' => ['class' => 'form-control',
                'placeholder' => 'Digite O Texto Acima',
                'data-position' => 'geral'
            ],

        ],$captcha);
    }

    /**
     * @param mixed $save
     */
    public function setSave($save)
    {
        $this->save =  array_replace([
            'name' => 'save',
            'attributes' => [
                'type' => 'submit',
                'value' => 'BTN_SAVE_LABEL',
                'title' => 'BTN_SAVE_DESC',
                'class' => 'btn btn-success submitbutton',
                'id' => 'save',
            ],
        ],$save);
    }

    /**
     * @param mixed $savecopy
     */
    public function setSavecopy($savecopy)
    {
        $this->savecopy =  array_replace([
            'name' => 'save_copy',
            'attributes' => [
                'type' => 'submit',
                'value' => 'BTN_SAVE_COPY_LABEL',
                'title' => 'BTN_SAVE_COPY_DESC',
                'class' => 'btn btn-primary submitbutton',
                'id' => 'save_copy',
                'disabled'=>true
            ],
        ],$savecopy);
    }

    /**
     * @return \Base\View\Helper\Form\Custom\Captcha\CustomCaptcha
     * @internal param mixed $captchaImage
     */
    public function getCaptchaImage()
    {
        $this->captchaImage = new CustomCaptcha(array(
                'font' => $this->dirdata,
                'width' => 200,
                'height' => 100,
                'wordLen' => 2,
                'dotNoiseLevel' => 50,
                'lineNoiseLevel' => 3)
        );
        $this->captchaImage->setImgDir($this->urlcaptcha);
        $this->captchaImage->setMessage('Captcha Invalida.',Image::BAD_CAPTCHA);
        return $this->captchaImage;

    }


    public function setValueOption($table, $condicao = array('state' => '0')) {
        $dados = $this->container->get($table)->findBy($condicao);
        $valueOptions = array('--SELECIONE--');
        if ($dados->getResult()):
            foreach ($dados->getData() as $value):
                $valueOptions[$value->getId()] =sprintf("%s - %s",$value->getId(),$value->getTitle());
            endforeach;
        endif;

        return $valueOptions;
    }



    public function setCustonValueOption($table,$index='id',$valor='title', $condicao = array('state' => '0')) {
        $dados = $this->container->get($table)->findBy($condicao);
        $valueOptions =[];
        if ($dados):
            foreach ($dados as $value):
                $op=$value->toArray();
                $valueOptions[$op[$index]] = $op[$valor];
            endforeach;
        endif;

        return $valueOptions;
    }




}