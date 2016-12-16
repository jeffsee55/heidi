<?php

namespace Heidi\Plugin\Callbacks\Admin;

use Heidi\Core\Callback;

class VacationRentalPage extends Callback
{
    public function render($post)
    {
        $existingValue = get_post_meta( $post->ID, 'unit_code', true ) ?: '';

        if($existingValue)
            echo '<p>Unit Code: ' . $existingValue . '</p>';
    }
}
