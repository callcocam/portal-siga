<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:10
 */

namespace Home\Controller;


use Auth\Model\Users\UsersRepository;
use Home\Form\ForgottenPasswordFilter;
use Home\Form\ForgottenPasswordForm;
use Interop\Container\ContainerInterface;
use Mail\Service\Mail;
use Zend\Db\Adapter\AdapterInterface;
use Zend\View\Model\ViewModel;

class ForgottenPasswordController extends AbstractController{

    function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->form = ForgottenPasswordForm::class;
        $this->table=UsersRepository::class;
    }

    public function forgottenpasswordAction()
    {
        //PEGA OS DADOS DO USUARIO NO BANCO PELO EMAIL
        if($this->IdentityManager->hasIdentity()):
            $this->Messages()->flasshInfo("VOCÊ JÁ ESTA LOGADO");
            return $this->redirect()->toRoute('users');
        endif;

        $this->form = $this->getForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            $inputfilter=$this->container->get(ForgottenPasswordFilter::class);
            $inputfilter->dbAdapter=$this->container->get(AdapterInterface::class);
            $this->form->setInputFilter($inputfilter->getInputFilter());
            //VERIFICA SE O FORMULARIO E VALIDO
            if ($this->form->isValid()) {
                $this->data = $this->form->getData();
                $usr_email = $this->data['email'];
                //PEGA OS DADOS DO USUARIO NO BANCO PELO EMAIL
                $auth = $this->getTable()->getUserByEmail($usr_email);
                //VERIFICA SE ENCONTRO UM USUARIO
                if ($auth) {
                    //GERA UMA NOVA MSENHA
                    $password = $this->generatePassword();
                    $auth->getData()->setPassword($this->encryptPassword($usr_email, $password));
                    //TENTA ALTERAR A SENHA NO BANCO
                    $result = $this->getTable()->update($auth->getData());
                    //SE ALTERO A SENHA ENVIA POR EMAIL
                    if ($result) {
                        $this->Messages()->flashSuccess("MSG_FORGOTTEN_PASSWORD_SUCCCESS");
                        //ENVIA A SENHA POR EMAIL
                        $this->sendPasswordByEmail($usr_email, $password);
                        return $this->redirect()->toRoute('authenticate');
                    } else {
                        $this->Messages()->error("MSG_FORGOTTEN_PASSWORD_ERROR");
                    }
                }
            } else {

                foreach ($this->form->getMessages() as $msg):
                    $this->Messages()->error(implode(PHP_EOL, $msg));
                endforeach;
            }
        }
        return new ViewModel(array('form' => $this->form));

    }

    /**
     * @param $usr_email
     * @param $password
     */
    public function sendPasswordByEmail($usr_email, $password) {
        $url = sprintf("%s", $this->getRequest()->getServer('HTTP_ORIGIN'));
        $data['url'] = $url;
        $data['password'] = $password;
        $mail = $this->container->get(Mail::class);
        $mail->setSubject('Your password has been changed!')
            ->setTo($usr_email)
            ->setData($data)
            ->setViewTemplate('forgotten-password');
        $mail->send();
    }


    public function passwordChangeSuccessAction() {
        if($this->user)
        {
            return $this->redirect()->toRoute("auth");
        }
        return new ViewModel(['usr_email'=>$this->usr_email]);
    }


    public function generatePassword($l = 8, $c = 0, $n = 0, $s = 0) {
        // get count of all required minimum special chars
        $count = $c + $n + $s;
        $out = '';
        // sanitize inputs; should be self-explanatory
        if (!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
            trigger_error('Argument(s) not an integer', E_USER_WARNING);
            return false;
        } elseif ($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
            trigger_error('Argument(s) out of range', E_USER_WARNING);
            return false;
        } elseif ($c > $l) {
            trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
            return false;
        } elseif ($n > $l) {
            trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
            return false;
        } elseif ($s > $l) {
            trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
            return false;
        } elseif ($count > $l) {
            trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
            return false;
        }

        // all inputs clean, proceed to build password
        // change these strings if you want to include or exclude possible password characters
        $chars = "abcdefghijklmnopqrstuvwxyz";
        $caps = strtoupper($chars);
        $nums = "0123456789";
        $syms = "!@#$%^&*()-+?";

        // build the base password of all lower-case letters
        for ($i = 0; $i < $l; $i++) {
            $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }

        // create arrays if special character(s) required
        if ($count) {
            // split base password to array; create special chars array
            $tmp1 = str_split($out);
            $tmp2 = array();

            // add required special character(s) to second array
            for ($i = 0; $i < $c; $i++) {
                array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
            }
            for ($i = 0; $i < $n; $i++) {
                array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
            }
            for ($i = 0; $i < $s; $i++) {
                array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
            }

            // hack off a chunk of the base password array that's as big as the special chars array
            $tmp1 = array_slice($tmp1, 0, $l - $count);
            // merge special character(s) array with base password array
            $tmp1 = array_merge($tmp1, $tmp2);
            // mix the characters up
            shuffle($tmp1);
            // convert to string for output
            $out = implode('', $tmp1);
        }

        return $out;
    }
}

