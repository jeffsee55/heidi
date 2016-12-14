<?php

namespace Heidi\Plugin\Callbacks\Admin;

class VacationRentalPage
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
