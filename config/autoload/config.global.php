<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 23:03
 */
return [
    'zf-config'=>[
                'staticsalt'=>'aFGQ475SDsdfsaf2342',
                'sessao'=>'funcionarios',
               'serverHost'=>'http://rest.callcocam.com.br',
                //'serverHost'=>'http://localhost.server',
                'captchaImage'=>[
                            'wordLen' => 5,
                            'width' => 200,
                            'height' => 100,
                            'dirdata' => './data/fonts/arial.ttf',
                            'urlcaptcha'=>''
                            ],
                'ecfop'=>'555',
                'scfop'=>'666',
                'cst'=>'102',
                'clfiscal'=>'000000',
                'unidade'=>'UN',
                 'cpgto'=>['0'=>'A VISTA','1'=>'30 DIAS DIRETO','2'=>'1 + 1 = 2 VESEZ','3'=>'1 + 2 = 3 VESEZ','4'=>'1 + 3 = 4 VESEZ','5'=>'1 + 4 = 5 VESEZ'],
                 'fpgto'=>['1'=>"A VISTA",'2'=>"PAGAMENTO VIA PAYPAL",'3'=>"CARTAO DE CREDITO",'4'=>"BOLETO BANCARIO",'5'=>"CREDIARIO"],
                 ]
];

