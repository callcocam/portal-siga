<?php
namespace Auth;
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 21/07/2016
 * Time: 01:38
 */

use Auth\Controller\Factory\PrivilegesControllerFactory;
use Auth\Controller\Factory\ProfileControllerFactory;
use Auth\Controller\Factory\ResourcesControllerFactory;
use Auth\Controller\Factory\RolesControllerFactory;
use Auth\Controller\Factory\UsersControllerFactory;
use Auth\Controller\ProfileController;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'profile' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/profile[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\ProfileController::class,
                        'action'     => 'profile',
                    ],

                ],

            ],
            'users' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/users[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\UsersController::class,
                        'action'     => 'index',
                        'id'=>'0',
                        'page'=>'1'
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '[/:page]',
                            'defaults' => [
                                'controller' => Controller\UsersController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'users-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => Controller\UsersController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],


                ]
            ],

            'resources' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/resources[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\ResourcesController::class,
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
                                'controller' => Controller\ResourcesController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'resources-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => Controller\ResourcesController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],
                   ]
            ],

            'roles' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/roles[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\RolesController::class,
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
                                'controller' => Controller\RolesController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'roles-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => Controller\RolesController::class,
                                'action'     => 'create',
                            ],
                        ],
                    ],

                ]
            ],

            'privileges' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/privileges[/:action][/:id][/:page]',
                    'defaults' => [
                        'controller' => Controller\PrivilegesController::class,
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
                                'controller' => Controller\PrivilegesController::class,
                                'page'     => '1',
                            ],
                        ],
                    ],
                    'privileges-create' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/create',
                            'defaults' => [
                                'controller' => Controller\PrivilegesController::class,
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
            Controller\ProfileController::class => ProfileControllerFactory::class,
            Controller\UsersController::class => UsersControllerFactory::class,
            Controller\ResourcesController::class => ResourcesControllerFactory::class,
            Controller\RolesController::class => RolesControllerFactory::class,
            Controller\PrivilegesController::class => PrivilegesControllerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
