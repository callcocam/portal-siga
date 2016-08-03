<?php
namespace Mail;
use Mail\Service\Mail;
return [
    'Mail' =>[
        'transport' => [
            'smtpOptions' => [
                'host' => 'rlin70.hpwoc.com',
                'port' => 587,
                'connection_class' => 'login',
                'connection_config' => [
                    'username' => 'suporte@agenciajm.com.br',
                    'password' => 'vmiq2552',
                    'from' => 'contato@callcocam.com.br'
               ],
            ],
            'transportSsl' => [
                'use_ssl' => false,
                'connection_type' => 'tls' // ssl, tls
           ],
        ],
        'options' => [
            'type' => 'text/html',
            'html_encoding' => \Zend\Mime\Mime::ENCODING_8BIT,
            'message_encoding' => 'UTF8'
       ]
   ],
     'service_manager' =>[
        'factories' =>[
           Mail::class=>Factory\MailFactory::class
        ]
    ],
     'view_manager' => [
    'template_path_stack' => [
        __DIR__ . '/../view',
    ],
],
];