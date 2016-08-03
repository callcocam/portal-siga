<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 13:18
 */

namespace Make\Services;


use Interop\Container\ContainerInterface;
use Zend\Code\Generator\ClassGenerator;

class RepositoryFactory extends Options {

    public function __construct($data, ContainerInterface $container) {

        $this->container = $container;
        extract($data);
        //$this->setTable(strtolower($tabela));
        // Poxfix e o que completa o nome do arquivo ArquivoPosfix (ArquivoForm)
        $this->setPosfix("RepositoryFactory");
        // E tanto o o nome do arquivo como o nome da class
        $this->setName($arquivo);
        // ex:Form, Entity, Service
        $this->setSubDir(sprintf("Model\\%s\\Factory",$arquivo));
        // Montar o caminho base
        $aFind = array('DS', 'dirBase', 'dirEntity');
        $aSub = array(DIRECTORY_SEPARATOR, $alias, 'Model');
        $dirBase = str_replace($aFind, $aSub, ".DSmodule_restDSdirBaseDSsrc");
        // Base dir geralmente e ./module/src/Modulo
        $this->setBaseDir($dirBase);
        // Name Space ex:Modulo\Form
        $this->setNameSpace(sprintf("%s\\Model\\%s\\Factory", $alias,$arquivo));
        // Se e uma extenção de outra classe set setExtends
        $this->setExtends("AbstractFactory");
        // Se e uma extenção de outra classe set setExtends
        $this->setImplements(array('FactoryInterface'));
        // set os use
        $this->setUses(array(
            'Base\Model\Factory\AbstractFactory' => null,
            'Zend\ServiceManager\Factory\FactoryInterface' => null,
            'Interop\Container\ContainerInterface' => null,
            sprintf('%s\Model\%s\%sRepository', $alias, $arquivo,$arquivo) => null,
            sprintf('%s\Model\%s\%s', $alias, $arquivo,$arquivo) => null,
        ));
        $class = new ClassGenerator();
        if ($this->getUses()) {
            foreach ($this->getUses() as $key => $value) {
                $class->addUse($key, $value);
            }
        }
        $this->setBody('// Configurações iniciais do Factory Table');
        // gera os methods podemos erar mais de um repetindo o codigo

        $this->setBody(sprintf('return new %sRepository($this->tableGateway("bs_%s",%s::class,$container));', $arquivo,strtolower($tabela),$arquivo));

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

        $class->setName($this->getName())->setImplementedInterfaces($this->getImplements())
            ->setNamespaceName($this->getNameSpace())
            ->setExtendedClass($this->getExtends())
            ->setDocblock($this->getDocblock())
            ->addProperties($this->getProperties())
            ->addConstants($this->getConstants())
            ->addMethods($this->getMethod());
        $this->setGenerateClasse($class);
    }

} 