<?php
namespace Cidadeonline;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 19:21
 */


use Cidadeonline\Controller\CategoriasController;
use Cidadeonline\Controller\ClassificadosController;
use Cidadeonline\Controller\ClientesController;
use Cidadeonline\Controller\ComentariosController;
use Cidadeonline\Controller\EmpresasController;
use Cidadeonline\Controller\Factory\CategoriasControllerFactory;
use Cidadeonline\Controller\Factory\CidadeonlineControllerFactory;
use Cidadeonline\Controller\Factory\ClassificadosControllerFactory;
use Cidadeonline\Controller\Factory\ClientesControllerFactory;
use Cidadeonline\Controller\Factory\ComentariosControllerFactory;
use Cidadeonline\Controller\Factory\EmpresasControllerFactory;
use Cidadeonline\Controller\Factory\PostsControllerFactory;
use Cidadeonline\Controller\PostsController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [

           'cidadeonline' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/cidadeonline',
                    'defaults' => [
                        'controller' => Controller\CidadeonlineController::class,
                        'action'     => 'index',
                    ],

                ],

            ],
             'cidadeonline-pages' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/cidadeonline[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\CidadeonlineController::class,
                        'action'     => 'index',
                        'id'=>'',
                        'page'=>'0'
                    ],
                ],
            ],

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
            'comentarios' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/comentarios[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\ComentariosController::class,
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
                                'controller' => Controller\ComentariosController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'comentarios-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/comentarios',
                            'defaults' => [
                                'controller' => Controller\ComentariosController::class,
                                'action'     => 'create',
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

          ],
    ],
    'controllers' => [
        'factories' => [
            Controller\CidadeonlineController::class => CidadeonlineControllerFactory::class,
            CategoriasController::class=>CategoriasControllerFactory::class,
            EmpresasController::class=>EmpresasControllerFactory::class,
            PostsController::class=>PostsControllerFactory::class,
            ClassificadosController::class=>ClassificadosControllerFactory::class,
            ComentariosController::class=>ComentariosControllerFactory::class,
            ClientesController::class=>ClientesControllerFactory::class,

        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
