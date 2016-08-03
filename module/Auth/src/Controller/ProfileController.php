<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:28
 */

namespace Auth\Controller;



use Auth\Form\ProfileFilter;
use Auth\Form\ProfileForm;
use Auth\Form\UpdatePasswordFilter;
use Auth\Form\UpdatePasswordForm;
use Auth\Model\Users\Users;
use Auth\Model\Users\UsersRepository;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class ProfileController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->table=UsersRepository::class;
        $this->model=Users::class;
        $this->filter=ProfileFilter::class;
        $this->form=ProfileForm::class;
        $this->controller="users";
        $this->route="users";
    }
    public function profileAction(){
        $user=$this->IdentityManager->hasIdentity();
        $this->getForm();
        $this->form->setData((array)$user);
        $view=new ViewModel(['users'=>$user,'form'=>$this->form]);
        return $view;
    }
    public function updatepasswordAction(){
        $this->filter=UpdatePasswordFilter::class;
        $this->form=UpdatePasswordForm::class;
        $user=$this->IdentityManager->hasIdentity();
        $this->getForm();
        $view=new ViewModel(['users'=>$user,'form'=>$this->form]);
        return $view;
    }

    public function updatepasswordprofileAction()
    {
        $user=$this->IdentityManager->hasIdentity();
        $this->filter=UpdatePasswordFilter::class;
        $this->form=UpdatePasswordForm::class;
        $this->getForm();
        $this->getData();
        $this->form->setData($this->data);
        $inputfilter=$this->getFilter();
        $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
        $this->form->setInputFilter($inputfilter->getInputFilter());
        //VERIFICA SE O FORMULARIO E VALIDO
        if ($this->form->isValid()) {
                $this->data['password']=$this->encryptPassword($user->email,$this->data['password']);
                $this->getTable()->changePassword($user->id,$this->data['password']);
                return new JsonModel($this->getTable()->getData()->toArray());
        }
        else{
            $error=[];
            foreach ($this->form->getMessages() as $key=> $messages){
                foreach($messages as  $ms){
                    $error[$key]=sprintf("[%s-%s]",$key,$ms);
                }
            }

        }
        return new JsonModel(['result'=>false,'class'=>'danger','error'=>implode(PHP_EOL,$error)]);

    }

}