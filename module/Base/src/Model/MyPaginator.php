<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 28/07/2016
 * Time: 08:56
 */

namespace Base\Model;


use Zend\Paginator\Paginator;

class MyPaginator extends Paginator {

    public function __construct($adapter)
    {
        parent::__construct($adapter);
       //$cache=new Cache();
       // $this->setCache($cache->getCache());
    }

} 