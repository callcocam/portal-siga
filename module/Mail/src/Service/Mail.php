<?php

namespace Mail\Service;

use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Message;

class Mail implements MailInterface {

    protected $transport;
    protected $options;
    protected $template;
    protected $subject;
    protected $from;
    protected $to;
    protected $data;
    protected $viewTemplate;

    public function __construct($transport, $options, $template) {
        $this->transport = $transport; // $serviceLocator->get('mail-transport');
        $this->options = $options; //$serviceLocator->get('mail-options');
        $this->template = $template; //$serviceLocator->get('mail-template');
    }

    public function setSubject($subject) {
        $this->subject = $subject;

        return $this;
    }

    public function setTo($to) {
        $this->to = $to;

        return $this;
    }

    function setFrom($from) {
        $this->from = $from;
        return $this;
    }

    public function setData($data) {
        $this->data = $data;

        return $this;
    }

    public function setViewTemplate($viewTemplate) {
        $this->viewTemplate = $viewTemplate;

        return $this;
    }

    public function execute() {
        $html = new MimePart($this->template->render($this->viewTemplate, $this->data));
        $html->type = $this->options->getType();
        $html->encoding = $this->options->getHtmlEncoding();
        $body = new MimeMessage();
        $body->setParts(array($html));
        $config = $this->transport->getOptions()->toArray();
        $message = new Message();
        if(empty($this->from)):
            $from=$config['connection_config']['from'];
        else:
            $from=  $this->from;
        endif;
        $message->addFrom($from)
                ->addTo($this->to)
                ->setSubject($this->subject)
                ->setBody($body)
                ->setEncoding($this->options->getMessageEncoding());

        if (count($this->options->getBcc())) {
            $message->addBcc($this->options->getBcc());
        }

        return $message;
    }

    public function send() {
        $this->transport->send($this->execute());
    }

}
