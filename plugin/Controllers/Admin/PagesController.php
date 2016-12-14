<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Plugin\Callbacks\Admin\Page;

class PagesController
{
    function addPage()
    {
        add_menu_page(
            'Special Settings',
            'Special Settings',
            'manage_options',
            'special-settings',
            [new Page, 'render']
        );
    }
}
