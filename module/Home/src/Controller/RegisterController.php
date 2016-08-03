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
use Home\Controller\AbstractController;
use Home\Form\RegisterFilter;
use Home\Form\RegisterForm;
use Interop\Container\ContainerInterface;
use Mail\Service\Mail;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Debug\Debug;
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
           // Debug::dump($this->form->getMessages());
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

    /**
     * Envia um email de confirmação para o usuario
     * que se cadastrou no site
     * junto com um oken de confirmação
     * assunto ->Subject
     * dados do email ->Data
     * template de email ->Template
     * @param $data
     */
    public function sendConfirmationEmail($data) {
        if(!$data):
            return $this->redirect()->toRoute('authenticate');
        endif;
        $url = sprintf("%s%s", $this->getRequest()->getServer('HTTP_ORIGIN'), $this->url()->fromRoute('confirm-register', array(
            'action' => 'confirm-email', 'id' => $data['usr_registration_token'])));
        $data['url'] = $url;
        $mail = $this->container->get(Mail::class);
        //SETAMOS AS INFORMAÇÕES DE ENVIO
        $mail->setSubject('Por favor, confirme seu cadastro!')
            ->setTo($data['email'])
            ->setData($data)
            ->setViewTemplate('confirmacao');
        $mail->send();
    }


    /**
     * Quando o usuario clicar no email enviado
     * no momento do cadastro esta action ativara o cadastro
     * feito no site
     * @return ViewModel
     */
    public function confirmEmailAction() {
        $token = $this->params()->fromRoute('id');
        $template='/home/register/confirm-email-error';
        $viewModel = new ViewModel(array('token' => $token));
            $user = $this->getTable()->getUserByToken($token);
            if($user->getResult()){
                if($this->getTable()->activateUser($user->getData()->getId())){
                    $template='/home/register/confirm-email';
                }
            }
            $viewModel->setTemplate($template);
            return $viewModel;
    }

}