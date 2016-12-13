<?php

namespace Heidi\Plugin\Callbacks;

use Heidi\Plugin\Models\Post;

class AdminView
{
    public function render()
    {
        $post = new Post(1);
        view('admin.admin_settings', compact('post'));
    }
}
