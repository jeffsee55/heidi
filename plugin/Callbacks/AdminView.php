<?php

namespace Heidi\Plugin\Callbacks;

use Heidi\Plugin\Models\User;

class AdminView
{
    public function render()
    {
        $user = new User(1);
        view('admin.admin_settings', compact('user'));
    }
}
