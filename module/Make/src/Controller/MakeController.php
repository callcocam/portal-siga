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
        $table=$this->params()->fromRoute('table');
        if(!empty($module) && !empty($table)){
            $data['alias']=$module;
            $data['arquivo']=$table;
            $data['tabela']=$table;
            if(!is_dir(sprintf("./module_rest/{$module}/src/Model/{$table}"))){
                mkdir(sprintf("./module_rest/{$module}/src/Model/{$table}"));
            }
            $model=new Model($data,$this->container);
            $model->generateClass();
            $msg[]="Model {$table} Foi Criado Com Sucesso!";

            /*Model Factory*/
            if(!is_dir(sprintf("./module_rest/{$module}/src/Model/{$table}/Factory"))){
                mkdir(sprintf("./module_rest/{$module}/src/Model/{$table}/Factory"));
            }
            $modelFactory=new FactoryModel($data,$this->container);
            $modelFactory->generateClass();
            $msg[]="Model Factory {$table} Foi Criado Com Sucesso!";


            $repository=new Repository($data,$this->container);
            $repository->generateClass();
            $msg[]="Repository {$table} Foi Criado Com Sucesso!";

            $repositoryFactory=new RepositoryFactory($data,$this->container);
            $repositoryFactory->generateClass();
            $msg[]="Repository Factory {$table} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./module_rest/{$module}/src/Controller"))){
                mkdir(sprintf("./module_rest/{$module}/src/Controller"));
            }
            $controller=new Controller($data,$this->container);
            $controller->generateClass();
            $msg[]="Controller {$table} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./module_rest/{$module}/src/Controller/Factory"))){
                mkdir(sprintf("./module_rest/{$module}/src/Controller/Factory"));
            }
            $controllerFactory=new ControllerFactory($data,$this->container);
            $controllerFactory->generateClass();
            $msg[]="Controller Factory {$table} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./module_rest/{$module}/src/Form"))){
                mkdir(sprintf("./module_rest/{$module}/src/Form"));
            }
            $form=new Form($data,$this->container);
            $form->generateClass();
            $msg[]="Form {$table} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./module_rest/{$module}/src/Form/Factory"))){
                mkdir(sprintf("./module_rest/{$module}/src/Form/Factory"));
            }
            $formFactory=new FactoryForm($data,$this->container);
            $formFactory->generateClass();
            $msg[]="Form Factory {$table} Foi Criado Com Sucesso!";

            $filter=new Filter($data,$this->container);
            $filter->generateClass();
            $msg[]="Filter {$table} Foi Criado Com Sucesso!";

            $filterFactory=new FactoryFilter($data,$this->container);
            $filterFactory->generateClass();
            $msg[]=PHP_EOL;
            $msg[]="Filter Factory {$table} Foi Criado Com Sucesso!";
            $msg[]="Você Pode Ainda Adicionar Os Serviços No Arquivo module/{$module}/Module.php";
            $msg[]="{$table}::class=>{$table}Factory::class,";
            $msg[]="{$table}Repository::class=>{$table}RepositoryFactory::class,";
            $msg[]="{$table}Form::class=>{$table}FormFactory::class,";
            $msg[]="{$table}Filter::class=>{$table}FilterFactory::class,";

            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Adicionar Os Serviços No Arquivo module/{$module}/config/module.config.php";
            $msg[]="{$table}Conroller::class=>{$table}ControllerFactory::class,";

            return new ViewModel(['error'=>$msg]);

        }
        return new ViewModel(['error'=>"Nenhum Parametro Valido Foi Passado, Você Deve Passar Um Model E Uma Tabela"]);
    }


}