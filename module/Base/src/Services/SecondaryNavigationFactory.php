<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 08/08/2016
 * Time: 16:57
 */

namespace Base\Services;


use Zend\Navigation\Service\DefaultNavigationFactory;

class SecondaryNavigationFactory extends DefaultNavigationFactory {
    protected function getName()
    {
        return 'secondary';
    }


} 