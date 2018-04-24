<?php

class Health_Api_Server extends WP_REST_Controller
{
    // The namespace and version for the REST SERVER
    const NAMESPACE = 'health/v';
    const VERSION = '1';

    public function __construct()
    {
        add_action(
            'rest_api_init',
            [
                $this,
                'register_routes',
            ]
        );
    }

    public function register_routes()
    {
        register_rest_route(
            self::NAMESPACE . self::VERSION,
            'check',
            [
                'methods'  => WP_REST_Server::READABLE,
                'callback' => [
                    $this,
                    'check'
                ],
            ]
        );
    }

    public function check()
    {
        return [
            'status' => 'OK',
            'release' => Mamis_Deployment_Info::getReleaseName(),
        ];
    }
}
