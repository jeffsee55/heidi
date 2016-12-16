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

        self::$httpClient = new HttpClient([

            // 'base_uri' => get_site_option('q4vr_api_url') . '/api/',
            'base_uri' => "http://q4vr-api.app/api/",

        ]);

        try {

            $response = self::$httpClient->request('GET', $path, [

                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk4YTU4ZDUxYjllOTZmOGE0MGQ1YjczNWJmZWE5NTE0N2U3NzRiYzc2ODFkZWI5YWRmMTVmZGRhYzYzZWIzNzQxZGIzMTk2MGRmMjkxNDIwIn0.eyJhdWQiOiIxOCIsImp0aSI6Ijk4YTU4ZDUxYjllOTZmOGE0MGQ1YjczNWJmZWE5NTE0N2U3NzRiYzc2ODFkZWI5YWRmMTVmZGRhYzYzZWIzNzQxZGIzMTk2MGRmMjkxNDIwIiwiaWF0IjoxNDgxNTc5MzI4LCJuYmYiOjE0ODE1NzkzMjgsImV4cCI6NDYzNzI1MjkyOCwic3ViIjoiOSIsInNjb3BlcyI6W119.J8-alHVNkK8tmENh8fLIDk18WsRlGaHXKxfBDvN61Gebk1znOZ761_X6DFxfHHTVz3f7limnz0PrQ5PIc_HabZT7P6AST4V22VQTwWoC_SM9uP81x8wM5q10ykjUJKg6M9I6oW5uVRWy6zmK1ai95_IY1Ed707YXb3K-Aw36hiy0CJr5L8CHyyBBMffq7QbXQv5MoMB_ykmK1nly18_WHP-HvQVhCKonrbgFb0avltlfIyCQOEGmu1pltFUguZMCJiT28iuGggPyQ0kxpdm9gZqM4YS_rorJrQt3CXjamXVGEEegg4Ne_AebkyZ4GqG6crgL8voegazX1mcCdBXGndWTVZI-LYfb-vwumYiAulRZL8uqH3czqfLoh8HRdP0rHQ28OAcOnt0-7NYPtb9paCi-iifnML8Q5fncv-WjL_u4Ef3mNFKH_mFbl_fusIeCzh0OHQNHVNb47YKp0NNIngah6sHowAg29k0rbA3vqLis9gobl7iT-oTgseYP543QPCWb9zXROCvaX6Hm7IviqMl4GVfGIzrhq3iutFdMuFtuoLGxUsjAGCoHSpKujMJBxfaOLiNX80arAqJKLKE99b14v9nkoVt6Y5t3echD_toHNPjwhXbz3GUdTtxce3W1loRLQM77kBpqIbZLVd3kLLQ1rZY8mnAE--seXQ3PHNA',
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
