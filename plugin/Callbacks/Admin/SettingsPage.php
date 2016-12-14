<?php

namespace Heidi\Plugin\Callbacks\Admin;

class SettingsPage
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

    public function renderImportMetaBox()
    {
        view('admin.settings.import_box');
    }

    public function settingsFooter()
    {
        view('admin.settings.footer', compact($this->hook_suffix));
    }
}
