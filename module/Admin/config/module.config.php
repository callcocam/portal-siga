<?php
namespace Admin;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 21:26
 */

use Admin\Controller\ClientesController;
use Admin\Controller\Factory\AdminControllerFactory;
use Admin\Controller\Factory\BancosControllerFactory;
use Admin\Controller\Factory\ClientesControllerFactory;
use Admin\Controller\Factory\IssusersControllerFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => Controller\AdminController::class,
                        'action'     => 'index',
                    ],

                ],

            ],
            'issusers' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/issusers[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\IssusersController::class,
                        'action'     => 'index',
                        'id'=>'0',
                        'page'=>'1'
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '[/:page]',
                            'defaults' => [
                                'controller' => Controller\IssusersController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                ]
            ],
            'clientes' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/clientes[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\ClientesController::class,
                        'action'     => 'index',
                        'id'=>'0',
                        'page'=>'1'
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '[/:page]',
                            'defaults' => [
                                'controller' => Controller\ClientesController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'clientes-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/clientes',
                            'defaults' => [
                                'controller' => Controller\ClientesController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],
                ]
            ],
            'bancos' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/bancos[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\BancosController::class,
                        'action'     => 'index',
                        'id'=>'0',
                        'page'=>'1'
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '[/:page]',
                            'defaults' => [
                                'controller' => Controller\BancosController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'bancos-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/bancos',
                            'defaults' => [
                                'controller' => Controller\BancosController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],
                ]
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AdminController::class => AdminControllerFactory::class,
            Controller\IssusersController::class => IssusersControllerFactory::class,
            Controller\ClientesController::class => ClientesControllerFactory::class,
            Controller\BancosController::class => BancosControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
