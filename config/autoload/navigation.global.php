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
                'resource' => 'admin_controller_admincontroller',
                'action' => 'index',
                'icone'=>'fa fa-home',
                'privilege' => 'index',
            ],
            [
                'label' => 'Ir Para O Site',
                'route' => 'home',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline_controller_cidadeonlinecontroller',
                'action' => 'index',
                'icone'=>'fa fa-globe',
                'privilege' => 'index',
                'target'=>'_blank'
            ],
            [
                'label' => 'Controle De Acesso',
                'route' => 'users',
                'controller' => 'users',
                'resource' => 'auth_controller_userscontroller',
                'action' => 'index',
                'privilege' => 'index',
                'icone'=>'fa fa-lock',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Usuarios',
                        'route' => 'users',
                        'controller' => 'users',
                        'resource' => 'auth_controller_userscontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Usuario',
                                'route' => 'users',
                                'controller' => 'users',
                                'resource' => 'auth_controller_userscontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Usuario',
                                'route' => 'users',
                                'controller' => 'users',
                                'resource' => 'auth_controller_userscontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Resources',
                        'route' => 'resources',
                        'controller' => 'auth_controller_resourcescontroller',
                        'resource' => 'auth',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Resources',
                                'route' => 'resources',
                                'controller' => 'resources',
                                'resource' => 'auth_controller_resourcescontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Resources',
                                'route' => 'resources',
                                'controller' => 'resources',
                                'resource' => 'auth_controller_resourcescontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Roles',
                        'route' => 'roles',
                        'controller' => 'roles',
                        'resource' => 'auth_controller_rolescontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Roles',
                                'route' => 'roles',
                                'controller' => 'roles',
                                'resource' => 'auth_controller_rolescontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Roles',
                                'route' => 'roles',
                                'controller' => 'roles',
                                'resource' => 'auth_controller_rolescontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Privileges',
                        'route' => 'privileges',
                        'controller' => 'privileges',
                        'resource' => 'auth_controller_privilegescontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Privileges',
                                'route' => 'privileges',
                                'controller' => 'auth_controller_privilegescontroller',
                                'resource' => 'auth',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Privileges',
                                'route' => 'privileges',
                                'controller' => 'auth_controller_privilegescontroller',
                                'resource' => 'auth',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                ]
            ],
            [
                'label' => 'Cidade Online',
                'route' => 'clientes',
                'controller' => 'clientes',
                'resource' => 'cidadeonline_controller_clientescontroller',
                'action' => 'index',
                'privilege' => 'index',
                'icone'=>'fa fa-gear',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Clentes',
                        'route' => 'clientes',
                        'controller' => 'clientes',
                        'resource' => 'cidadeonline_controller_clientescontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Clentes',
                                'route' => 'clientes',
                                'controller' => 'clientes',
                                'resource' => 'cidadeonline_controller_clientescontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Clente',
                                'route' => 'clientes',
                                'controller' => 'clientes',
                                'resource' => 'cidadeonline_controller_clientescontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Categorias',
                        'route' => 'categorias',
                        'controller' => 'categorias',
                        'resource' => 'cidadeonline_controller_categoriascontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Categorias',
                                'route' => 'categorias',
                                'controller' => 'categorias',
                                'resource' => 'cidadeonline_controller_categoriascontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Nova Categorias',
                                'route' => 'categorias',
                                'controller' => 'categorias',
                                'resource' => 'cidadeonline_controller_categoriascontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Empresas',
                        'route' => 'empresas',
                        'controller' => 'empresas',
                        'resource' => 'cidadeonline_controller_empresascontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Empresas',
                                'route' => 'empresas',
                                'controller' => 'empresas',
                                'resource' => 'cidadeonline_controller_empresascontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Nova Empresas',
                                'route' => 'empresas',
                                'controller' => 'empresas',
                                'resource' => 'cidadeonline_controller_empresascontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Posts',
                        'route' => 'posts',
                        'controller' => 'posts',
                        'resource' => 'cidadeonline_controller_postscontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Posts',
                                'route' => 'posts',
                                'controller' => 'posts',
                                'resource' => 'cidadeonline_controller_postscontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Nova Posts',
                                'route' => 'posts',
                                'controller' => 'posts',
                                'resource' => 'cidadeonline_controller_postscontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                      [
                        'label' => 'Classificados',
                        'route' => 'classificados',
                        'controller' => 'classificados',
                        'resource' => 'cidadeonline_controller_classificadoscontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Classificados',
                                'route' => 'classificados',
                                'controller' => 'classificados',
                                'resource' => 'cidadeonline_controller_classificadoscontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Classificados',
                                'route' => 'classificados',
                                'controller' => 'classificados',
                                'resource' => 'cidadeonline_controller_classificadoscontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Comentarios',
                        'route' => 'comentarios',
                        'controller' => 'comentarios',
                        'resource' => 'cidadeonline_controller_comentarioscontroller',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Comentarios',
                                'route' => 'comentarios',
                                'controller' => 'comentarios',
                                'resource' => 'cidadeonline_controller_comentarioscontroller',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Novo Comentarios',
                                'route' => 'comentarios',
                                'controller' => 'comentarios',
                                'resource' => 'cidadeonline_controller_comentarioscontroller',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],

                ]
            ],
            [
                'label' => 'Configurações',
                'route' => 'issusers',
                'controller' => 'users',
                'resource' => 'auth',
                'action' => 'index',
                'privilege' => 'index',
                'icone'=>'fa fa-gear',
                'class'=>'nav child_menu',
                'pages'=>[
                    [
                        'label' => 'Empresas',
                        'route' => 'issusers',
                        'controller' => 'issusers',
                        'resource' => 'admin',
                        'action' => 'index',
                        'privilege' => 'index',
                        'pages'=>[
                            [
                                'label' => 'Listar Empresas',
                                'route' => 'issusers',
                                'controller' => 'issusers',
                                'resource' => 'admin',
                                'action' => 'index',
                                'privilege' => 'index',
                            ],
                            [
                                'label' => 'Nova Empresa',
                                'route' => 'issusers',
                                'controller' => 'issusers',
                                'resource' => 'admin',
                                'action' => 'create',
                                'privilege' => 'create',
                            ]
                        ]
                    ],

                ]
            ],

            [
                'label' => 'Sair Do Sistema',
                'route' => 'authenticate-logout',
                'controller' => 'login',
                'resource' => 'home',
                'action' => 'logout',
                'icone'=>'fa fa-sign-out',
                'privilege' => 'logout',
                'class'=>'nav child_menu',
            ],


        ],
        'secondary'=>[
            [
                'label' => 'Home',
                'route' => 'home',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline',
                'action' => 'index',
                'icone'=>'fa fa-home',
                'privilege' => 'index',
            ],
            [
                'label' => 'Cidade Online',
                'route' => 'home',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline',
                'action' => 'index',
                'icone'=>'fa fa-home',
                'privilege' => 'index',
                'pages'=>[
                    [
                        'label' => 'ACONTECEU',
                        'route' => 'cidadeonline-pages',
                        'controller' => 'cidadeonline',
                        'resource' => 'cidadeonline',
                        'action' => 'blog-posts',
                        'privilege' => 'blog-posts',
                        'id' => 'aconteceu',

                    ],
                     [
                        'label' => 'EVENTOS',
                        'route' => 'cidadeonline-pages',
                        'controller' => 'cidadeonline',
                        'resource' => 'cidadeonline',
                        'action' => 'blog-posts',
                         'id' => 'eventos',
                        'privilege' => 'blog-posts',


                    ],
                     [
                        'label' => 'ESPORTES',
                        'route' => 'cidadeonline-pages',
                        'controller' => 'cidadeonline',
                        'resource' => 'cidadeonline',
                        'action' => 'blog-posts',
                        'privilege' => 'blog-posts',
                        'id' => 'esportes',

                    ],

                ]
            ],
            [
                'label' => 'ONDE COMPRAR',
                'route' => 'cidadeonline-pages',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline',
                'action' => 'onde-comprar',
                'icone'=>'fa fa-home',
                'privilege' => 'onde-comprar',
            ],
            [
                'label' => 'ONDE FICAR',
                'route' => 'cidadeonline-pages',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline',
                'action' => 'onde-ficar',
                'icone'=>'fa fa-home',
                'privilege' => 'onde-ficar',
            ],
            [
                'label' => 'ONDE COMER',
                'route' => 'cidadeonline-pages',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline',
                'action' => 'onde-comer',
                'icone'=>'fa fa-home',
                'privilege' => 'onde-comer',
            ],
            [
                'label' => 'ONDE  SE DIVERTIR',
                'route' => 'cidadeonline-pages',
                'controller' => 'cidadeonline',
                'resource' => 'cidadeonline',
                'action' => 'onde-se-divertir',
                'icone'=>'fa fa-home',
                'privilege' => 'onde-se-divertir',
            ],
        ]
    ],
];