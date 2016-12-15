<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Core\Controller;
use Heidi\Core\AdminPanel;
use Heidi\Plugin\Callbacks\Admin\SettingsPage;
use Heidi\Plugin\Models\SearchSettings;
use Heidi\Plugin\Models\ApiSettings;
use Heidi\Plugin\Models\GeneralSettings;

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
        AdminPanel::addMetaBoxes(new ApiSettings, $this->hook_suffix);
        AdminPanel::addMetaBoxes(new SearchSettings, $this->hook_suffix, 'advanced');

        add_meta_box(
            'submitdiv',
            'Import Status',
            [new SettingsPage, 'importBox'],
            $this->hook_suffix,
            'side',
            'high'
        );

        add_meta_box(
            'api-key',
            'API Status',
            [new SettingsPage, 'apiBox'],
            $this->hook_suffix,
            'side',
            'high'
        );
    }

    function enqueueScripts($hook_suffix)
    {

        if ($hook_suffix == $this->hook_suffix){

            wp_register_script( 'q4vr_admin_settings', HEIDI_RESOURCE_DIR . 'assets/js/admin_settings.js', ['jquery'], HEIDI_VERSION, true );

            wp_register_style( 'q4vr_admin_settings', HEIDI_RESOURCE_DIR . 'assets/css/admin_settings.css', [], HEIDI_VERSION);

            wp_enqueue_script( 'q4vr_admin_settings' );

            wp_enqueue_style( 'q4vr_admin_settings' );

            wp_enqueue_script( 'common' );

            wp_enqueue_script( 'wp-lists' );

            wp_enqueue_script( 'postbox' );
        }
    }

    public function saveGeneralSettings()
    {
        GeneralSettings::saveOptions($_POST);
    }

    public function saveSearchSettings()
    {
        SearchSettings::saveOptions($_POST);
    }

    public function saveApiSettings()
    {
        ApiSettings::saveOptions($_POST);
    }
}
