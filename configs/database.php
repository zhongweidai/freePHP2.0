<?php
return array (
    'DB_TYPE' => 'mysql',
    'DB_DEPLOY' =>  true,
    'DB_CHARSET' => 'utf8',
    'DB_DEBUG' => true,
    'DB_DEFAULT_NAME'=> 'mall',
    'DB_SERVER' => array(
        'DB:' => array (
            'database' => 'mall',
            'hostname' => '127.0.0.1',
            'username' => 'root',
            'password' => '123456',
        ),
        'DB_R:' => array (
            'database' => 'mall',
            'hostname' => '127.0.0.1',
            'username' => 'root',
            'password' => '123456',
        ),
        'DB:Mall' => array (
            'database' => 'mall',
            'hostname' => '192.168.30.1',
            'username' => 'mall',
            'password' => '123456',
        ),
        'DB_R:Mall' => array (
            'database' => 'mall',
            'hostname' => '192.168.30.1',
            'username' => 'mall',
            'password' => '123456',
        ),
    ),
    'DB_PARAMS' => array (
        \PDO::ATTR_CASE => \PDO::CASE_NATURAL
    ),
);
