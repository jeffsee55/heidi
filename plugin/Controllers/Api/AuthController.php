<?php

namespace Heidi\Plugin\Controllers\Api;

use Heidi\Core\Controller;

class AuthController extends Controller
{
    public function authorize()
    {
        $apiSettings = get_option('q4vr_api_settings')[0];

        $query = http_build_query(

            [
                'client_id' => $apiSettings['api_client_id'],
                'redirect_uri' => get_site_url() . '/wp-admin/admin-post.php?action=q4vr_callback',
                'response_type' => 'code'
            ]

        );

        return wp_redirect($apiSettings['api_url'] . '/oauth/authorize?' . $query);
    }

    public function callback()
    {
        $apiSettings = get_option('q4vr_api_settings')[0];

        $http = new \GuzzleHttp\Client();

        $redirect_to =  get_site_url() . '/wp-admin/edit.php?post_type=vacation_rental&page=q4vr-settings';

        try {

            $response = $http->post($apiSettings['api_url'] . '/oauth/token', [

                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => $apiSettings['api_client_id'],
                    'client_secret' => $apiSettings['api_secret'],
                    'redirect_uri' => get_site_url() . '/wp-admin/admin-post.php?action=' . $_GET['action'],
                    'code' => $_GET['code'],
                ]

            ]);

            $response = json_decode((string) $response->getBody(), true);

            update_site_option('q4vr_api_key', $response["access_token"]);

            $message = "API Key Updated";

            $redirect_to = add_query_arg('api_key_message', $message, $redirect_to);

            $redirect_to = add_query_arg('api_key_message_type', 'success', $redirect_to);

        } catch(\GuzzleHttp\Exception\ClientException $e) {

            $message = $e->getMessage();

            $redirect_to = add_query_arg('api_key_message', $message, $redirect_to);

            $redirect_to = add_query_arg('api_key_message_type', 'error', $redirect_to);

        }

        wp_redirect($redirect_to);
    }
}
