<?php
namespace Make;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 10:32
 */

use Make\Controller\Factory\MakeControllerFactory;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
           'make' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/make[/:action][/:module][/:classe][/:table]',
                    'defaults' => [
                        'controller' => Controller\MakeController::class,
                        'action'     => 'index',
                        'module'=>'0',
                        'classe'=>'0',
                        'table'=>'0'
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '[/:page]',
                            'defaults' => [
                                'controller' => Controller\MakeController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                ]
            ],


        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\MakeController::class => MakeControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];