<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Home\Controller;

use Admin\Model\Bancos\BancosRepository;
use Admin\Model\Clientes\ClientesRepository;
use Base\Services\Client;
use Interop\Container\ContainerInterface;
use Vendas\Form\BoletosFilter;
use Vendas\Form\BoletosForm;
use Vendas\Model\Boletos\Boletos;
use Vendas\Model\Boletos\BoletosRepository;
use Zend\View\Model\ViewModel;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class BoletosController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $container
     * @return \Home\Controller\BoletosController
     */
    public function __construct(ContainerInterface $container)
    {
        // Configurações iniciais do Controller
        $this->container=$container;
        $this->table=BoletosRepository::class;
        $this->model=Boletos::class;
        $this->form=BoletosForm::class;
        $this->filter=BoletosFilter::class;
        $this->route="boletos";
        $this->controller="boletos";
    }

    public function gerarboletoAction()
    {
        $body="O BANCO SELECIONA NÂO ESTA CADASTRADO OU ATIVO, OU NHENHUM CLIENTE FOI SELECIONADO";
        $param=$this->params()->fromRoute('id','bb');
        /**
         * @var $client ClientHttp
         */
        $clienteid=$this->VendasCart()->getItem('vendas');
        $this->table=ClientesRepository::class;
        $sacado=$this->getTable()->find($clienteid['cliente_id'],false);
        $this->table=BancosRepository::class;
        $banco=$this->getTable()->findOneBy(['codigo'=>$param],false);
        $this->table=BoletosFilter::class;
        if($banco->getResult()):
        $client = $this->container->get(Client::class);
        $client->setUri(sprintf("%s/%s",$this->config->serverHost,$param));
        $client->setMethod('POST');
        $client->setParameterPost([
            'banco'=>$banco->getData(),
            'cedente'  => ['title'=>$this->user->title,'cnpj'=> $this->user->cnpj, 'end'=>$this->user->endereco,'cep'=> $this->user->cep, 'cidade'=>$this->user->cidade,'uf'=>'SC'],
            'sacado'  => $sacado->getData(),
            'valor' =>$this->SigaContas()->write($clienteid['valor']),
            'created'   => $clienteid['created'],
        ]);
        $response = $client->send();
        if ($response->isSuccess()) {
           $body=$response->getBody();
        }
        endif;

        $viewModel=new ViewModel(['data'=>$body]);
        $viewModel->setTemplate("/admin/admin/tpl/vendas/iscape");
        $viewModel->setTerminal(true);
        return $viewModel;
    }

}

