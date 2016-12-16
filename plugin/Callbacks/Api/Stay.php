<?php

namespace Heidi\Plugin\Callbacks\Api;

use Heidi\Core\Callback;
use Heidi\Plugin\Models\ApiClient as Client;

class Stay extends Callback
{
    public static function get()
    {
        global $post;

        // $unitCode = get_post_meta($post->ID, 'unit_code', true);
        $unitCode = '103';

        $startDate = $_GET['start_date'];

        $endDate = $_GET['end_date'];

        $response = Client::get("units/{$unitCode}/stay/{$startDate}/{$endDate}");

    }
}
