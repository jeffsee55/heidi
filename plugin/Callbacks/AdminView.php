<?php

namespace Heidi\Plugin\Callbacks;

class AdminView
{
    public function render()
    {
        global $wp_query;
        $test = 'hello';
        view('admin.admin_settings', compact('test'));
    }
}
