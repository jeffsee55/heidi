<?php

$router->group('Api',
    [
        'UnitsController' => [
            'pre_get_posts'     => 'searchApi',
            'wp_ajax_load_more' => 'loadMore',
            'wp'                => ['addUnits', 'getUnit'],
            'init'              => 'addQueryVars',
        ],
        'AuthController' => [
            'admin_post_q4vr_authorize'         => 'authorize',
            'admin_post_nopriv_q4vr_callback'   => 'callback',
            'admin_post_q4vr_callback'          => 'callback'
        ],
        'StayController' => [
            'wp_ajax_nopriv_q4vr_stay'  => 'ajaxGetStay',
            'wp_ajax_q4vr_stay'         => 'ajaxGetStay',
        ],
        'CalendarController' => [
            'wp_ajax_nopriv_q4vr_calendar'  => 'getCalendar',
            'wp_ajax_q4vr_calendar'         => 'getCalendar'
        ],
        'ReservationsController' => [
            'wp'                                        => 'reservationStay',
            'wp_ajax_q4vr_create_reservation'           => 'createReservation',
            'wp_ajax_nopriv_q4vr_create_reservation'    => 'createReservation',
            'admin_post_q4vr_create_reservation'        => 'createReservation',
            'admin_post_nopriv_q4vr_create_reservation' => 'createReservation'
        ]
    ]
);

$router->group('Admin',
    [
        'VacationRentalsController' => [
            'template_include' => 'loadTemplates',
            'q4vr_single_page' => 'renderSingle',
            'init' => [
                'unregisterAccommodations',
                'registerPostType',
                'registerTaxonomies',
            ],
            'q4vr_archive_page' => 'renderArchive',
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
            'save_post' => 'saveMeta'
        ]
    ]
);
