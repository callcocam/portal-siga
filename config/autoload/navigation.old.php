<?php
use Zend\Navigation\ConfigProvider;

return [
    'service_manager' => (new ConfigProvider())->getDependencyConfig(),
    'navigation' => [
        'default' => [
            [
                'label' => 'Admin',
                'route' => 'admin',
                'controller' => 'admin',
                'resource' => 'admin',
                'action' => 'index',
                'privilege' => 'index',
            ],
            [
                'label' => 'Usuarios',
                'route' => 'users',
                'controller' => 'users',
                'resource' => 'auth',
                'action' => 'index',
                'privilege' => 'index',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Listar Usuario',
                        'route' => 'users',
                        'controller' => 'users',
                        'resource' => 'auth',
                        'action' => 'index',
                        'privilege' => 'index',
                    ],
                    [
                        'label' => 'Novo Usuario',
                        'route' => 'users',
                        'controller' => 'users',
                        'resource' => 'auth',
                        'action' => 'create',
                        'privilege' => 'create',
                    ]
                ]
            ],
            [
                'label' => 'Resources',
                'route' => 'resources',
                'controller' => 'resources',
                'resource' => 'auth',
                'action' => 'index',
                'privilege' => 'index',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Listar Resources',
                        'route' => 'resources',
                        'controller' => 'resources',
                        'resource' => 'auth',
                        'action' => 'index',
                        'privilege' => 'index',
                    ],
                    [
                        'label' => 'Novo Resources',
                        'route' => 'resources',
                        'controller' => 'resources',
                        'resource' => 'auth',
                        'action' => 'create',
                        'privilege' => 'create',
                    ]
                ]
            ],
            [
                'label' => 'Roles',
                'route' => 'roles',
                'controller' => 'roles',
                'resource' => 'auth',
                'action' => 'index',
                'privilege' => 'index',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Listar Roles',
                        'route' => 'roles',
                        'controller' => 'roles',
                        'resource' => 'auth',
                        'action' => 'index',
                        'privilege' => 'index',
                    ],
                    [
                        'label' => 'Novo Roles',
                        'route' => 'roles',
                        'controller' => 'roles',
                        'resource' => 'auth',
                        'action' => 'create',
                        'privilege' => 'create',
                    ]
                ]
            ],
            [
                'label' => 'Privileges',
                'route' => 'privileges',
                'controller' => 'privileges',
                'resource' => 'auth',
                'action' => 'index',
                'privilege' => 'index',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Listar Privileges',
                        'route' => 'privileges',
                        'controller' => 'privileges',
                        'resource' => 'auth',
                        'action' => 'index',
                        'privilege' => 'index',
                    ],
                    [
                        'label' => 'Novo Privileges',
                        'route' => 'privileges',
                        'controller' => 'privileges',
                        'resource' => 'auth',
                        'action' => 'create',
                        'privilege' => 'create',
                    ]
                ]
            ],
            [
                'label' => 'Sair Do Sistema',
                'route' => 'authenticate-logout',
                'controller' => 'login',
                'resource' => 'home',
                'action' => 'logout',
                'privilege' => 'logout',
                'class'=>'nav child_menu',
            ],


        ],
    ],
];