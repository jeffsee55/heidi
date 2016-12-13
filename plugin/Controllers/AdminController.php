<?php

namespace Heidi\Plugin\Controllers;

use Heidi\Plugin\Callbacks\AdminView;

class AdminController
{
    function registerSettingsPage()
    {
        add_menu_page(
            'Special Settings',
            'Special Settings',
            'manage_options',
            'special-settings',
            [new AdminView, 'render']
        );
    }
}
