<?php

namespace Heidi\Plugin\Callbacks\Api;

use Heidi\Core\Callback;
use Heidi\Plugin\Models\ApiClient as Client;
use Heidi\Plugin\Models\VacationRental;

class Search extends Callback
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

    public static function run($wp_query)
    {
        new static();

        $queryString = self::buildQueryString($wp_query);

        $response = Client::get('units', $queryString);

        if(property_exists($response, 'units'))
        {
            $units = array_map(function($unit) {
                new VacationRental($post, $unit);
            }, $response->units);
        }

        view('single', compact('units'));
    }

    public static function buildQueryString($wp_query)
    {
        $array = [];

        foreach(self::QUERY_VARS as $queryVar)
        {
            $array[$queryVar] = get_query_var($queryVar);
        }

        return http_build_query(array_filter($array));
    }

    public function addQueryVars($vars)
    {
        $searchVars = array_map(function($var) {
            return $var;
        }, self::QUERY_VARS);
        return array_merge($vars, $searchVars);
    }
}
