<?php

$router->group('Admin',
    [
        'VacationRentalsController' => [
            'template_include' => 'loadTemplates',
            'q4vr_single_page' => 'renderSingle',
            'q4vr_archive_page' => 'renderArchive',
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
            'admin_post_q4vr_general_settings' => 'saveGeneralSettings',
            'admin_post_q4vr_search_settings' => 'saveSearchSettings',
            'admin_post_q4vr_api_settings' => 'saveApiSettings',
            'wp_ajax_add_admin_panel' => 'addAdminPanel'
        ],
        'SplashPageController' => [
            'theme_page_templates' => 'registerSplashPage',
            'template_include' => 'loadSplashPage',
            'q4vr_splash_page' => 'renderSplash',
            'add_meta_boxes_page' => 'addMetaBoxes',
            'post_edit_form_tag' => 'addMultipart',
            'admin_enqueue_scripts' => 'enqueueScripts',
        ]
    ]
);
