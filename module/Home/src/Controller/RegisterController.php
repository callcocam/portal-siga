<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 22:28
 */

namespace Home\Controller;


use Auth\Model\Users\Users;
use Auth\Model\Users\UsersRepository;
use Home\Form\RegisterFilter;
use Home\Form\RegisterForm;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\View\Model\ViewModel;

class RegisterController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=UsersRepository::class;
        $this->model=Users::class;
        $this->filter=RegisterFilter::class;
        $this->form=RegisterForm::class;
    }

    public function registerAction()
    {
        $this->form=$this->getForm();
        $viewModel = new ViewModel(['form' => $this->form]);
        if (!$this->getData()) {
            return $viewModel;
        }

        $this->form->setData($this->data);
        $model=$this->getModel();
        $inputfilter=$this->getFilter();
        $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
        $this->form->setInputFilter($inputfilter->getInputFilter());
        if (! $this->form->isValid()) {
            $this->Messages()->error("OS DADOS PASSADOS SÃO INVALIDOS");
             return $viewModel;
        }
        try {
            $this->prepareData($this->data);
            $model->exchangeArray($this->data);
             $this->getTable()->insert($model);
            if($this->getTable()->getData()->getResult()){
                $this->Messages()->flashSuccess(sprintf('An e-mail has been sent to %s. Please, check your inbox and confirm your registration!', $this->data['email']));
                $this->sendConfirmationEmail($this->data);
            }
            else{
                $this->Messages()->error($this->getTable()->getData()->getError());
                return $viewModel;
            }

        } catch (\Exception $ex) {
            throw $ex;
        }
        return $this->redirect()->toRoute('authenticate');

    }

}