<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 29/07/2016
 * Time: 11:50
 */

namespace Base\Form\Interfaces;


use Interop\Container\ContainerInterface;

interface AbstractFormInterface {

    public function __construct(ContainerInterface $container, $name, $options = []);

} 