<?php

namespace Heidi\Plugin\Callbacks\Admin;

use Heidi\Plugin\Models\User;

class Page
{
    public function render()
    {
        $user = new User(1);
        view('admin.admin_settings', compact('user'));
    }
}
