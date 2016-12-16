<?php

namespace Heidi\Plugin\Callbacks\Api;

use Heidi\Core\Callback;
use Heidi\Plugin\Models\ApiClient as Client;
use Heidi\Plugin\Models\VacationRental;

class Unit extends Callback
{
    const QUERY_VARS = [
        'start_date',
        'end_date',
        'guests',
        'min_bedrooms',
        'min_bathrooms',
        'property_type',
        'filter',
        'amenities',
        'paged',
    ];

    public static function get($wp_query)
    {
        new static();

        global $post;

        $unitCode = get_post_meta($post->ID, 'unit_code', true);

        $unit = Client::get('units/103');

        $unit = new VacationRental($post, $unit);

        view('single', compact('unit'));
    }
}
