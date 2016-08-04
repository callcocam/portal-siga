<?php
namespace Portal;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 20/07/2016
 * Time: 21:26
 */

use Portal\Controller\CategoriasController;
use Portal\Controller\Factory\CategoriasControllerFactory;
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
            ],

    ],
    'controllers' => [
        'factories' => [
            CategoriasController::class=>CategoriasControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
