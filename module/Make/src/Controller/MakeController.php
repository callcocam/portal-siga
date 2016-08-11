<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 10:39
 */

namespace Make\Controller;


use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Make\Services\Controller;
use Make\Services\ControllerFactory;
use Make\Services\FactoryFilter;
use Make\Services\FactoryForm;
use Make\Services\FactoryModel;
use Make\Services\Filter;
use Make\Services\Form;
use Make\Services\Model;
use Make\Services\Repository;
use Make\Services\RepositoryFactory;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;

class MakeController extends AbstractController{

    /**
     * @param ContainerInterface $container
     */
    function __construct(ContainerInterface $container)
    {
        // TODO: Implement __construct() method.
        $this->container = $container;
        $this->template="admin/admin/index";

    }
    public function gerarAction()
    {
      
        $module=$this->params()->fromRoute('module');
        $classe=$this->params()->fromRoute('classe');
        $table=$this->params()->fromRoute('table');
        if(!empty($module) && !empty($table)){
            $data['alias']=$module;
            $data['arquivo']=$classe;
            $data['tabela']=$table;
            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}"));
            }
            $model=new Model($data,$this->container);
            $model->generateClass();
            $msg[]="Model {$classe} Foi Criado Com Sucesso!";

            /*Model Factory*/
            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}/Factory"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}/Factory"));
            }
            $modelFactory=new FactoryModel($data,$this->container);
            $modelFactory->generateClass();
            $msg[]="Model Factory {$classe} Foi Criado Com Sucesso!";


            $repository=new Repository($data,$this->container);
            $repository->generateClass();
            $msg[]="Repository {$classe} Foi Criado Com Sucesso!";

            $repositoryFactory=new RepositoryFactory($data,$this->container);
            $repositoryFactory->generateClass();
            $msg[]="Repository Factory {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Controller"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Controller"));
            }
            $controller=new Controller($data,$this->container);
            $controller->generateClass();
            $msg[]="Controller {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Controller/Factory"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Controller/Factory"));
            }
            $controllerFactory=new ControllerFactory($data,$this->container);
            $controllerFactory->generateClass();
            $msg[]="Controller Factory {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Form"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Form"));
            }
            $form=new Form($data,$this->container);
            $form->generateClass();
            $msg[]="Form {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Form/Factory"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Form/Factory"));
            }
            $formFactory=new FactoryForm($data,$this->container);
            $formFactory->generateClass();
            $msg[]="Form Factory {$classe} Foi Criado Com Sucesso!";

            $filter=new Filter($data,$this->container);
            $filter->generateClass();
            $msg[]="Filter {$classe} Foi Criado Com Sucesso!";

            $filterFactory=new FactoryFilter($data,$this->container);
            $filterFactory->generateClass();
            $msg[]=PHP_EOL;
            $msg[]="Filter Factory {$classe} Foi Criado Com Sucesso!";
            $msg[]="Você Pode Ainda Adicionar Os Serviços No Arquivo module/{$module}/Module.php";
            $msg[]="{$classe}::class=>{$classe}Factory::class,";
            $msg[]="{$classe}Repository::class=>{$classe}RepositoryFactory::class,";
            $msg[]="{$classe}Form::class=>{$classe}FormFactory::class,";
            $msg[]="{$classe}Filter::class=>{$classe}FilterFactory::class,";

            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Adicionar Os Serviços No Arquivo module/{$module}/config/module.config.php";
            $msg[]="{$classe}Conroller::class=>{$classe}ControllerFactory::class,";

            return new ViewModel(['error'=>$msg]);

        }
        return new ViewModel(['error'=>"Nenhum Parametro Valido Foi Passado, Você Deve Passar Um Model E Uma Tabela"]);
    }


}