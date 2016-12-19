<?php

namespace Heidi\Plugin\Models;

use Heidi\Core\BaseOption;
use GuzzleHttp\Client as HttpClient;

class ApiClient
{
    protected static $httpClient;

    public static function get($path, $query = null)
    {
        $path = $path . '?' . $query;

        $apiSettings = get_option('q4vr_api_settings')[0];

        self::$httpClient = new HttpClient([

            'base_uri' => $apiSettings['api_url'] . '/api/',

        ]);

        try {

            $response = self::$httpClient->request('GET', $path, [

                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . get_option('q4vr_api_key'),
                ]

            ]);

        } catch(\GuzzleHttp\Exception\ServerException $e) {

            return (object) ['error' => (object) ['code' => 500, 'message' => 'Api service temporarily unavailable']];

        } catch(\GuzzleHttp\Exception\ClientException $e) {

            return (object) ['error' => (object) ['code' => 401, 'message' => 'You are not authorized to use this service']];

        }

        return json_decode((string) $response->getBody());
    }
}
