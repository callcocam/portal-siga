<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 11:37
 */

namespace Make\Services;


use Interop\Container\ContainerInterface;
use Zend\Code\Generator\ClassGenerator;

class FactoryForm extends Options {
    public function __construct($data, ContainerInterface $container) {

        $this->container=$container;
        extract($data);
        // Poxfix e o que completa o nome do arquivo ArquivoPosfix (ArquivoForm)
        $this->setPosfix("FormFactory");
        // E tanto o o nome do arquivo como o nome da class
        $this->setName($arquivo);
        // ex:Form, Entity, Service
        $this->setSubDir("Form\\Factory");
        // Montar o caminho base
        $aFind = array('DS', 'dirBase', 'dirEntity');
        $aSub = array(DIRECTORY_SEPARATOR, $alias, 'Form\\Factory');
        $dirBase = str_replace($aFind, $aSub, ".DSmodule_restDSdirBaseDSsrc");
        // Base dir geralmente e ./module/src/Modulo
        $this->setBaseDir($dirBase);
        // Name Space ex:Modulo\Form
        $this->setNameSpace(sprintf("%s\\Form\\Factory", $alias,$arquivo));
        // Se e uma extenção de outra classe set setExtends
        // set os use
        $this->setUses(array(
            'Interop\Container\ContainerInterface' => null,
            'Zend\ServiceManager\Factory\FactoryInterface' => null,
            sprintf('%s\Form\%sForm',$alias,$arquivo)=> null
        ));
        $class = new ClassGenerator();
        if ($this->getUses()) {
            foreach ($this->getUses() as $key => $value) {
                $class->addUse($key, $value);
            }
        }
        $this->setImplements(array('FactoryInterface'));
        $this->setBody('// Configurações iniciais do Factory Model');
        // gera os methods podemos erar mais de um repetindo o codigo
        $this->setBody(sprintf('return new %sForm($container);',$arquivo));
        // gera os methods podemos erar mais de um repetindo o codigo
        $methodOption = ['name' => "__invoke",
            'parameter' => [
                ['name' => "container", 'type' => 'ContainerInterface', 'value' => false],
                ['name' => "requestedName", 'type' => null, 'value' => false],
                ['name' => "options", 'type' => 'array', 'value' => null]
            ],
            'shortDescription' => "__invoke Factory Model",
            'longDescription' => null,
            'datatype' => '__invoke',
            'body' => sprintf(implode(PHP_EOL, $this->getBody()), $arquivo)
        ];

        $methodConstruct = new Methods($methodOption);
        $this->setMethod($methodConstruct);
        $this->setBody("limpa");

        $class->setName($this->getName())
            ->setNamespaceName($this->getNameSpace())
            ->setImplementedInterfaces($this->getImplements())
            ->setDocblock($this->getDocblock())
            ->addProperties($this->getProperties())
            ->addConstants($this->getConstants())
            ->addMethods($this->getMethod());
        $this->setGenerateClasse($class);
    }
} 