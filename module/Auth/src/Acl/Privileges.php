<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 15/07/2016
 * Time: 00:36
 */

namespace Auth\Acl;


class Privileges {
 protected $privileges=[
                        ['privilege'=>['index','create','edit','delete'],'resource'=>'admin','role'=>'2'],
                        ['privilege'=>['index','create'],'resource'=>'admin','role'=>'3'],
                        ['privilege'=>['index'],'resource'=>'admin','role'=>'4'],
                        ['privilege'=>['index','logout'],'resource'=>'admin','role'=>'5'],
                        ['privilege'=>['index','create','edit','delete'],'resource'=>'auth','role'=>'2'],
                        ['privilege'=>['index','create'],'resource'=>'auth','role'=>'3'],
                        ['privilege'=>['index','register','logout'],'resource'=>'auth','role'=>'4'],
                        ['privilege'=>['index','login'],'resource'=>'auth','role'=>'5'],
                        ['privilege'=>['index','create','edit','delete'],'resource'=>'nfe','role'=>'3'],

 ];
    public function getPrivileges()
    {
        return $this->privileges;
    }
} 