<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Plugin\Callbacks\Admin\SettingsPage;

class PagesController
{
    function addPage()
    {
        add_menu_page(
            'Special Settings',
            'Special Settings',
            'manage_options',
            'special-settings',
            [new SettingsPage, 'render']
        );
    }

    function addMetaBoxes()
    {
        add_meta_box(
            'submitdiv',
            'Import Status',
            [new SettingsPage, 'renderImportMetaBox'],
            'toplevel_page_special-settings',
            'normal',
            'high'
        );
    }

    function enqueueScripts($hook_suffix)
    {
        $page_hook_id = 'toplevel_page_special-settings';
        if ( $hook_suffix == $page_hook_id ){
            wp_enqueue_script( 'common' );
            wp_enqueue_script( 'wp-lists' );
            wp_enqueue_script( 'postbox' );
        }
    }
}
