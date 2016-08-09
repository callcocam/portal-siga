<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;
/**
 * Description of CacheHelper
 *
 * @author Claudio
 */
class CacheHelper extends AbstractHelper {
    protected $cache;
    public function __construct() {
        $this->cache=new \Base\Model\Cache();
    }

    public function getItem($key) {
        return $this->cache->getItem($key);
    }
}
