<?php
namespace Portal;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 21:26
 */

use Portal\Controller\CategoriasController;
use Portal\Controller\ClassificadosController;
use Portal\Controller\EmpresasController;
use Portal\Controller\Factory\CategoriasControllerFactory;
use Portal\Controller\Factory\ClassificadosControllerFactory;
use Portal\Controller\Factory\EmpresasControllerFactory;
use Portal\Controller\Factory\PostsControllerFactory;
use Portal\Controller\PostsController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
return [
    'router' => [
        'routes' => [
            'categorias' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/categorias[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\CategoriasController::class,
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
                                'controller' => Controller\CategoriasController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'categorias-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/categorias',
                            'defaults' => [
                                'controller' => Controller\CategoriasController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],
                ]
            ],
            'empresas' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/empresas[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\EmpresasController::class,
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
                                'controller' => Controller\EmpresasController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'empresas-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/empresas',
                            'defaults' => [
                                'controller' => Controller\EmpresasController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],
                ]
            ],
            'posts' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/posts[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\PostsController::class,
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
                                'controller' => Controller\PostsController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'posts-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/posts',
                            'defaults' => [
                                'controller' => Controller\PostsController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],
                ]
            ],
            'classificados' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/classificados[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\ClassificadosController::class,
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
                                'controller' => Controller\ClassificadosController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'posts-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/classificados',
                            'defaults' => [
                                'controller' => Controller\ClassificadosController::class,
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
            CategoriasController::class=>CategoriasControllerFactory::class,
            EmpresasController::class=>EmpresasControllerFactory::class,
            PostsController::class=>PostsControllerFactory::class,
            ClassificadosController::class=>ClassificadosControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
