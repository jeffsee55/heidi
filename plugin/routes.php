<?php

$router->group('Admin',
    [
        'PagesController' => [
            'admin_menu'  => 'addPage',
            'add_meta_boxes' => 'addMetaBoxes',
            'admin_enqueue_scripts' => 'enqueueScripts'
        ]
    ]
);
