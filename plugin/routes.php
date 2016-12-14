<?php

$router->group('Admin',
    [
        'PagesController' => [
            'admin_menu'  => 'addPage',
        ]
    ]
);
