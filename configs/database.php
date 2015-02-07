<?php
return array (
    'oracle' => array (
        ////'hostname' => '10.8.6.239',
        'hostname' => '127.0.0.1',
        'database' => '',
        'username' => 'whty3',
        'password' => 'whty3',
        'servicename' => 'XE',
        'charset' => 'utf8',
        'debug' => true,
        'pconnect' =>1,
        'autoconnect' => 0,
    ),
    'mysql' => array (
        'database' => 'shopnc',
        'hostname' => '192.168.1.100',
        'username' => 'user',
        'password' => '123456',

        /** 'hostname' => '10.8.9.237',
        'username' => 'portal',
        'password' => 'portal',**/
        'tablepre' => 'shopnc_',
        'charset' => 'utf8',
        'debug' => true,
        'pconnect' => 0,
        'autoconnect' => 0
    ),
);
