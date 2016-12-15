<?php
wp_editor( $row->value, 'filtered_search_wysiwyg' . rand(), $settings = array(
    'textarea_name' => $row->option,
    'textarea_rows' => 5,
    'wpautop' => false,
) );
