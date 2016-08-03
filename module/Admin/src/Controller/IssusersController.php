<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 21:29
 */

namespace Admin\Controller;



use Admin\Form\IssusersFilter;
use Admin\Form\IssusersForm;
use Admin\Model\Issusers\Issusers;
use Admin\Model\Issusers\IssusersRepository;
use Base\Controller\AbstractController;
use Base\Services\Client;
use Base\Services\ClientHttp;
use Interop\Container\ContainerInterface;
use Zend\View\Model\ViewModel;

class IssusersController extends AbstractController  {

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=IssusersRepository::class;
        $this->model=Issusers::class;
        $this->form=IssusersForm::class;
        $this->filter=IssusersFilter::class;
        $this->route="issusers";
        $this->controller="issusers";

    }

    /**
     *
     */
    public function createAction()
    {
        /**
         * @var $client ClientHttp
         */
        $client = $this->container->get(Client::class);

        $client->setUri(sprintf("%s/%s",$this->config->serverHost,'nfe/create'));
        $client->setMethod('POST');
        $client->setParameterPost([
            'first_name'  => 'Bender',
            'middle_name' => 'Bending',
            'last_name'   => 'Rodríguez',
            'made_in'     => 'Mexico',
        ]);
        $response = $client->send();

        if ($response->isSuccess()) {

        }
        $this->data=$response->getBody();
        $viewModel=new ViewModel(['data'=>$this->data]);
        return $viewModel;
    }
}