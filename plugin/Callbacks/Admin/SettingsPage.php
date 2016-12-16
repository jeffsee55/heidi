<?php

namespace Heidi\Plugin\Callbacks\Admin;

use Heidi\Core\Callback;
use Heidi\Plugin\Models\ApiClient as Client;

class SettingsPage extends Callback
{
    protected $hook_suffix;

    public function render()
    {
        global $hook_suffix;
        $this->hook_suffix = $hook_suffix;

        do_action('add_meta_boxes', $hook_suffix );

        add_action("admin_footer-{$hook_suffix}", [$this, 'settingsFooter']);

        view('admin.settings_page', compact('hook_suffix'));
    }

    public function generalBox()
    {
        view('admin.settings.general_box');
    }

    public function importBox()
    {
        $response = Client::get('units');

        if(property_exists($response, 'units'))
        {

            $unit_codes = array_pluck($response->units, 'unit_code');

            view('admin.settings.import_box', compact('unit_codes'));

        }
    }

    public function apiBox()
    {
        view('admin.settings.api_box');
    }

    public function settingsFooter()
    {
        view('admin.settings.footer', compact($this->hook_suffix));
    }
}
