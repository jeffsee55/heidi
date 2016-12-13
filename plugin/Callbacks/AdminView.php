<?php

namespace Heidi\Plugin\Callbacks;

class AdminView
{
    public function render()
    {
        return view('admin_settings', compact('data'));
    }
}
