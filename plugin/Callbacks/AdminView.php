<?php

namespace Heidi\Plugin\Callbacks;

class AdminView
{
    public function render()
    {
        global $wp_query;
        $test = 'hello';
        view('admin_settings', compact('wp_query'));
    }
}
