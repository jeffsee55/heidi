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

        AdminPanel::addMetaBoxes(new SearchSettings, $this->hook_suffix, 'advanced', true);

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
        //TODO Register these scripts somewhere that makes sense
        wp_register_script( 'q4vr_admin_settings', HEIDI_RESOURCE_DIR . 'assets/js/admin_settings.js', ['jquery'], HEIDI_VERSION, true );

        wp_register_script( 'q4vr_admin_media', HEIDI_RESOURCE_DIR . 'assets/js/admin_media.js', ['jquery'], HEIDI_VERSION, true );

        wp_register_script( 'q4vr_admin_ajax', HEIDI_RESOURCE_DIR . 'assets/js/admin_ajax.js', ['jquery', 'q4vr_admin_media'], HEIDI_VERSION, true );

        wp_register_style( 'q4vr_admin_settings', HEIDI_RESOURCE_DIR . 'assets/css/admin_settings.css', [], HEIDI_VERSION);

        if ($hook_suffix == $this->hook_suffix)
        {
            wp_enqueue_script( 'q4vr_admin_settings' );

            wp_enqueue_script( 'q4vr_admin_media' );

            wp_enqueue_script( 'q4vr_admin_ajax');

            wp_enqueue_style( 'q4vr_admin_settings' );

            wp_enqueue_media();

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

    public function addAdminPanel()
    {
        $callback_args['args'] = [null, $_GET['index']];

        ob_start(); ?>

        <div class="postbox q4vr-admin-panel-can-add">

            <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text">New Panel</span><span class="toggle-indicator" aria-hidden="true"></span></button>

            <h2 class="hndle ui-sortable-handle"><span>New Panel</span></h2>

            <div class="inside">

            <?php (new AdminPanel($_GET['schema']))->render(null, $callback_args); ?>

            </div>

        </div>

        <?php

        $html = ob_get_clean();

        wp_send_json_success($html);
    }
}
