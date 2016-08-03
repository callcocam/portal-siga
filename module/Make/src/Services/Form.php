<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 14:28
 */

namespace Make\Services;


use Interop\Container\ContainerInterface;
use Zend\Code\Generator\ClassGenerator;
use Zend\Debug\Debug;

class Form extends Options {


    protected $tabelaElements;
    protected $attr = array('id', 'title', 'requerid', 'valor_padrao', 'placeholder', 'readonly', 'class', 'style', 'multiple', 'rows', 'cols', 'min', 'max', 'step', 'data-access', 'data-position');
    protected $attrHidden = array('value');
    protected $images = array('1'=>'images');
    protected $controller = array('1'=>'state','2'=>'access','3'=>'created','4'=>'modified');

    public function __construct($data, ContainerInterface $container) {

        $this->container=$container;
        extract($data);
        $this->setTable(strtolower($tabela));
        // Poxfix e o que completa o nome do arquivo ArquivoPosfix (ArquivoForm)
        $this->setPosfix("Form");
        // E tanto o o nome do arquivo como o nome da class
        $this->setName($arquivo);
        // ex:Form, Entity, Service
        $this->setSubDir("Form");
        // Montar o caminho base
        $aFind = array('DS', 'dirBase', 'dirEntity');
        $aSub = array(DIRECTORY_SEPARATOR, $alias, 'Form');
        $dirBase = str_replace($aFind, $aSub, ".DSmodule_restDSdirBaseDSsrc");
        // Base dir geralmente e ./module/Modulo/src/Modulo
        $this->setBaseDir($dirBase);
        // Name Space ex:Modulo\Form
        $this->setNameSpace(sprintf("%s\\Form", $alias));
        // Se e uma extenção de outra classe set setExtends
        $this->setExtends("AbstractForm");
        // set os use
        $this->setUses(array('Base\Form\AbstractForm' => null, 'Interop\Container\ContainerInterface' => null));
        $class = new ClassGenerator();
        if ($this->getUses()) {
            foreach ($this->getUses() as $key => $value) {
                $class->addUse($key, $value);
            }
        }
        $this->setBody('// Configurações iniciais do Form');
        $this->setBody('$this->container = $container;');
        $this->setBody('$this->setId([]);');
        $this->setBody('$this->setAssetid([]);');
        $this->setBody('$this->setCodigo([]);');
        $this->setBody('$this->setAccess([]);');
        $this->setBody('$this->setCreated([]);');
        $this->setBody('$this->setEmpresa([]);');
        $this->setBody('$this->setModified(["type" => "hidden"]);');
        $this->setBody('$this->setSave([]);');
        $this->setBody('$this->setCsrf([]);');
        $this->setBody('$this->setState(["type" => "hidden"]);');
        $this->setBody('$this->setDescription([]);');
        $this->setBody('$this->getAuthservice();');
        $this->setBody('parent::__construct($container, $name, $options);');
        $this->setBody('$this->setAttributes(["action" => "'.strtolower($tabela).'", "class" => "form-geral Manager form-horizontal"]);');
           // gera os methods podemos erar mais de um repetindo o codigo
        if ($this->getTable()->getColumns()):
            foreach ($this->getTable()->getColumns() as $value):
                extract($value);

                if (!array_search($name, self::$ignore)):
                    $this->setBody($this->addElement($value));
                endif;
            endforeach;
        endif;
        $methodOption = array('name' => "__construct",
            'parameter' => array(
                array('name' => "container", 'type' => 'ContainerInterface', 'value' => false),
                array('name' => "name", 'type' => null, 'value' => $arquivo),
                array('name' => "options", 'type' => 'array', 'value' => []),
            ),
            'shortDescription' => "construct do Table",
            'longDescription' => null,
            'datatype' => 'Base\Form\AbstractForm',
            'body' => implode(PHP_EOL, $this->getBody()));
        $methodConstruct = new Methods($methodOption);
        $this->setMethod($methodConstruct);
        $this->setBody("limpa");



        $class->setName($this->getName())
            ->setNamespaceName($this->getNameSpace())
            ->setExtendedClass($this->getExtends())
            ->setDocblock($this->getDocblock())
            ->addProperties($this->getProperties())
            ->addConstants($this->getConstants())
            ->addMethods($this->getMethod());
        $this->setGenerateClasse($class);
        //$this->generateClass();
    }

    public function addElement($value) {
        extract($value);
        $element['data-access'] = "3";
        $element['data-position'] = "geral";
        $options = $this->setOptions($value);
        $attributes = $this->setAttr($value);

        $body = <<<'EOT'
            //############################################ informações da coluna %s ##############################################:
		    $this->add([
	                   'type' => 'text',//hidden, select, radio, checkbox, textarea
	                    'name' => '%s',
	                    'options' => %s,
	                    'attributes' => %s,
	               ]
	            );
EOT;

        return sprintf($body, $name, $name, $options, $attributes) . PHP_EOL . PHP_EOL;
    }

    public function setAttr($value) {
        extract($value);
        $title=strtoupper($name);
        $attributes[] = "[";
        $attributes[] = "        'id'=>'{$name}',";
        $attributes[] = "        'class' =>'form-control',";
        $attributes[] = "        'title' => 'FILD_{$title}_DESC',";
        $attributes[] = "        'placeholder' => 'FILD_{$title}_PLACEHOLDER',";
        $attributes[] = "        'data-access' => '3',";
        $position="geral";
        if(array_search($name,$this->controller)){
            $position="datas";
        }

        if(array_search($name,$this->images)){
            $position="images";
        }

        $attributes[] = "        'data-position' => '{$position}',";
        $attributes[] = "        //'readonly' => true/false,";
        $attributes[] = "        //'requerid' => true/false,";
        $attributes[] = "    	        	        ]";
        return implode(PHP_EOL, $attributes);
    }
    public function setOptions($value) {
        extract($value);
        $label=strtoupper($name);
        $options[] = "[";
        $options[] = "             	'label' => 'FILD_{$label}_LABEL',";
        $options[] = "            	//'value_options'      =>[],";
        $options[] = '				//"disable_inarray_validator" => true,';
        $options[] = " ]";
        return implode(PHP_EOL, $options);
    }



} 