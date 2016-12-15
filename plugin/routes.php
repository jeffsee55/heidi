<?php

$router->group('Admin',
    [
        'VacationRentalsController' => [
            'init' => [
                'unregisterAccommodations',
                'registerPostType',
                'registerTaxonomies',
            ]
        ],
        'SettingsPageController' => [
            'admin_menu'  => 'addPage',
            'add_meta_boxes' => 'addMetaBoxes',
            'admin_enqueue_scripts' => 'enqueueScripts',
            'admin_post_q4vr_general_settings' => 'saveOptions'
        ]
    ]
);
