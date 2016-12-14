<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Plugin\Callbacks\Admin\SettingsPage;

class SettingsPageController
{
    protected $hook_suffix;

    function addPage()
    {
        $this->hook_suffix = add_menu_page(
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
            $this->hook_suffix,
            'normal',
            'high'
        );
    }

    function enqueueScripts($hook_suffix)
    {
        if ($hook_suffix == $this->hook_suffix){
            wp_enqueue_script( 'common' );
            wp_enqueue_script( 'wp-lists' );
            wp_enqueue_script( 'postbox' );
        }
    }
}
