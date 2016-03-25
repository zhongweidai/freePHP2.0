<?php
return array (
    'file' => array (
        'debug' => true,
        'file_path' => 'caches/data/',
    ),
    'memcache' => array(
        '0' => array (
            'hostname' => '10.8.6.239',
            'port' => 11211,
            'timeout' => 1,
        ),
    ),
    'mongo_db' => array(
        0=> array(
            'type' => 'mongo',
            'hostname' => '192.168.80.12',
            'database' => 'yledu',
            'username' => '',
            'password' => '',
            'port'     => '27017',
            'autoconnect' => 0,
        ),
    ),

    'redis' => array(
        '0' => array (
            'hostname' => '127.0.0.1',
            'port' => '6379',
            'timeout' => '0',
        ),
    ),
);