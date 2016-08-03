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
                    'route'    => '/users[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\UsersController::class,
                        'action'     => 'index',
                        'id'=>''
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'users-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/index',
                            'defaults' => [
                                'controller' => Controller\UsersController::class,
                                'action'     => 'index',
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
                    'users-update' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/update',
                            'defaults' => [
                                'controller' => Controller\UsersController::class,
                                'action'     => 'update',
                            ],
                        ],
                    ],
                    'users-delete' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller' => Controller\UsersController::class,
                                'action'     => 'delete',
                            ],
                        ],
                    ],

                ]
            ],

            'resources' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/resources[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\ResourcesController::class,
                        'action'     => 'index',
                        'id'=>''
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'resources-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/index',
                            'defaults' => [
                                'controller' => Controller\ResourcesController::class,
                                'action'     => 'index',
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
                    'resources-update' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/update',
                            'defaults' => [
                                'controller' => Controller\ResourcesController::class,
                                'action'     => 'update',
                            ],
                        ],
                    ],
                    'resources-delete' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller' => Controller\ResourcesController::class,
                                'action'     => 'delete',
                            ],
                        ],
                    ],

                ]
            ],

            'roles' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/roles[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\RolesController::class,
                        'action'     => 'index',
                        'id'=>''
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'roles-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/index',
                            'defaults' => [
                                'controller' => Controller\RolesController::class,
                                'action'     => 'index',
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
                    'roles-update' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/update',
                            'defaults' => [
                                'controller' => Controller\RolesController::class,
                                'action'     => 'update',
                            ],
                        ],
                    ],
                    'roles-delete' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller' => Controller\RolesController::class,
                                'action'     => 'delete',
                            ],
                        ],
                    ],

                ]
            ],

            'privileges' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/privileges[/:action][/:id]',
                    'defaults' => [
                        'controller' => Controller\PrivilegesController::class,
                        'action'     => 'index',
                        'id'=>''
                    ],

                ],
                'may_terminate' => true,
                'child_routes' => [
                    'privileges-list' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/index',
                            'defaults' => [
                                'controller' => Controller\PrivilegesController::class,
                                'action'     => 'index',
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
                    'privileges-update' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/update',
                            'defaults' => [
                                'controller' => Controller\PrivilegesController::class,
                                'action'     => 'update',
                            ],
                        ],
                    ],
                    'privileges-delete' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/delete',
                            'defaults' => [
                                'controller' => Controller\PrivilegesController::class,
                                'action'     => 'delete',
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
