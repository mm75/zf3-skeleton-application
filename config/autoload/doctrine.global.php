<?php

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOPgSql\Driver',
                'params' => [
                    'driverOptions' => [
                        1002 => 'SET NAMES utf8'
                    ]
                ]
            ]
        ]
    ]
];
