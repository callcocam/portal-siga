<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 14:29
 */

namespace Make\Services;


use Interop\Container\ContainerInterface;
use Zend\Code\Generator\ClassGenerator;

class Filter extends Options {


    public function __construct($data, ContainerInterface $container) {
        $this->container=$container;
        $this->setConfig();
        extract($data);
        $this->setTable(strtolower($tabela));
        // Poxfix e o que completa o nome do arquivo ArquivoPosfix (ArquivoForm)
        $this->setPosfix("Filter");
        // E tanto o o nome do arquivo como o nome da class
        $this->setName($arquivo);
        // ex:Form, Entity, Service
        $this->setSubDir("Form");
        // Montar o caminho base
        $aFind = array('DS', 'dirBase', 'dirEntity');
        $aSub = array(DIRECTORY_SEPARATOR, $alias, 'Form');
        $dirBase = str_replace($aFind, $aSub, ".DS{$this->config->module}DSdirBaseDSsrc");
        // Base dir geralmente e ./module/Modulo/src/Modulo
        $this->setBaseDir($dirBase);
        // Name Space ex:Modulo\Form
        $this->setNameSpace(sprintf("%s\\Form", $alias));
          // Se e uma extenção de outra classe set setExtends
        $this->setExtends("AbstractInputFilter");
        // set os use
        $this->setUses(array(
            'Base\Form\AbstractInputFilter' => null,
            'Interop\Container\ContainerInterface' => null,
            'Zend\Db\Adapter\AdapterInterface' => null,
            'Zend\Filter\StringTrim' => null,
            'Zend\Filter\StripTags' => null,
            'Zend\Validator\NotEmpty' => null,
        ));
        $class = new ClassGenerator();
        if ($this->getUses()) {
            foreach ($this->getUses() as $key => $value) {
                $class->addUse($key, $value);
            }
        }
        $this->setBody('// Configurações iniciais do Form');
        $this->setBody('$this->dbAdapter=$container->get(AdapterInterface::class);');
        $methodOption = array('name' => "__construct",
            'parameter' => array(
                array('name' => "container", 'type' => 'ContainerInterface', 'value' => false),
            ),
            'shortDescription' => "construct do Table",
            'longDescription' => null,
            'datatype' => 'Base\Form\AbstractInputFilter',
            'body' => implode(PHP_EOL, $this->getBody()));
        $methodConstruct = new Methods($methodOption);
        $this->setMethod($methodConstruct);
        $this->setBody("limpa");


        $this->setBody('$this->setId([]);');
        $this->setBody('$this->setAssetid([]);');
        $this->setBody('$this->setCodigo([]);');
        $this->setBody('$this->setAccess([]);');
        $this->setBody('$this->setCreated([]);');
        $this->setBody('$this->setEmpresa([]);');
        $this->setBody('$this->setModified([]);');
        $this->setBody('$this->setState([]);');
        $this->setBody('$this->setDescription([]);');
        $this->setBody('$inputFilter = parent::getInputFilter();');


       // gera os methods podemos erar mais de um repetindo o codigo
        if ($this->getTable()->getColumns()):
            foreach ($this->getTable()->getColumns() as $value):
                extract($value);

                if (!array_search($name, self::$ignore)):
                    $this->setBody($this->addElement($value));
                endif;
            endforeach;
        endif;
        $this->setBody('return $inputFilter;');
        $methodOption = array('name' => "getInputFilter",
            'parameter' =>null,
            'shortDescription' => "construct do Filter",
            'longDescription' => null,
            'datatype' => 'InputFilter',
            'body' => implode(PHP_EOL, $this->getBody()));
        $methodgetInputFilter = new Methods($methodOption);
        $this->setMethod($methodgetInputFilter);
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
        $body = <<<'EOT'
            //############################################ informações da coluna %s ##############################################:
             $inputFilter->add([
            'name' => '%s',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [NotEmpty::IS_EMPTY => "Campo Obrigatorio"]
                    ],
                ],
            ],
        ]);
EOT;

        return sprintf($body, $name,$name) . PHP_EOL . PHP_EOL;
    }

}