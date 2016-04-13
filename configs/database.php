<?php
return array (
    'DB_TYPE' => 'mysql',
    'DB_DEPLOY' =>  true,
    'DB_CHARSET' => 'utf8',
    'DB_DEBUG' => true,
    'DB_DEFAULT_NAME'=> 'weiphp',
    'DB_SERVER' => array(
        'DB:' => array (
            'database' => 'weiphp',
            'hostname' => '127.0.0.1',
            'username' => 'root',
            'password' => 'dodoca',
        ),
        'DB_R:' => array (
            'database' => 'weiphp',
            'hostname' => '127.0.0.1',
            'username' => 'root',
            'password' => 'dodoca',
        ),
        'DB:mall' => array (
            'database' => 'mall',
            'hostname' => '192.168.30.1',
            'username' => 'mall',
            'password' => '123456',
        ),
        'DB_R:mall' => array (
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
