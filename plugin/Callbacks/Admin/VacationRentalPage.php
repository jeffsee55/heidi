<?php

namespace Heidi\Plugin\Callbacks\Admin;

use Heidi\Core\Callback;

class VacationRentalPage extends Callback
{
    public function render($post, $metaBox)
    {
        foreach( $metaBox['args'] as $meta => $displayName ) {

            $existingValue = get_post_meta( $post->ID, $meta, true ) ?: '';

            if($existingValue)
                echo '<p>' . $displayName . ':' . $existingValue . '</p>';

        }
    }
}
