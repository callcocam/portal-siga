<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Base;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
// or in config/autoload/global.php:
    'translator' => [
        'locale' => 'pt_BR',
        'translation_file_patterns' => [
            [
                'type'     => 'phparray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php',
            ],
        ],
    ],
    'view_manager' => [
        'strategies'=> [
            'ViewJsonStrategy'
        ],
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'home/layout'           => __DIR__ . '/../view/layout/home.phtml',
            'cidadeonline_controller_cidadeonlinecontroller/layout'           => __DIR__ . '/../view/layout/portal.phtml',
            'loadcommentsposts/layout'           => __DIR__ . '/../view/layout/transp.phtml',
            'loadcommentsempresas/layout'           => __DIR__ . '/../view/layout/transp.phtml',
            'loadcommentsclassificados/layout'           => __DIR__ . '/../view/layout/transp.phtml',
            'authenticate/layout'           => __DIR__ . '/../view/layout/auth.phtml',
            'register/layout'           => __DIR__ . '/../view/layout/auth.phtml',
            'confirm-email/layout'           => __DIR__ . '/../view/layout/auth.phtml',
            'forgotten-password/layout'           => __DIR__ . '/../view/layout/auth.phtml',
            'error/layout'           => __DIR__ . '/../view/layout/error.phtml',
            'base/index/index' => __DIR__ . '/../view/base/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
