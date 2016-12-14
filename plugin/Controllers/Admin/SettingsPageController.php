<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Core\Controller;
use Heidi\Plugin\Callbacks\Admin\SettingsPage;

class SettingsPageController extends Controller
{
    public $hook_suffix;

    function addPage()
    {
        $this->hook_suffix = add_submenu_page(
            'edit.php?post_type=vacation_rental',
            'Q4VR Settings',
            'Settings',
            'manage_options',
            'q4vr-settings',
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
        wp_register_script( 'q4vr_admin_settings', HEIDI_RESOURCE_DIR . 'assets/js/admin_settings.js', ['jquery'], HEIDI_VERSION, true );
        if ($hook_suffix == $this->hook_suffix){
            wp_enqueue_script( 'q4vr_admin_settings' );
            wp_enqueue_script( 'common' );
            wp_enqueue_script( 'wp-lists' );
            wp_enqueue_script( 'postbox' );
        }
    }
}
