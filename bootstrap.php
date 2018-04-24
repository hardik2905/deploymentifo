<?php
/*
Plugin Name: Mamis Deployment Info
Plugin URI:  https://www.shippit.com
Description: This will show the current release details for the website in the footer when logged in as admin user.
Version:     1.0
Author:      Mamis IT
Author URI:  https://www.mamis.com.au
License:     GPL2 etc
License URI: https://www.mamis.com.au
*/

if (!defined('ABSPATH')) {
    die('Access denied.');
}

add_action('init', 'init_mamis_deployment_info');

function init_mamis_deployment_info()
{
    require_once(ABSPATH . '/wp-load.php');
    require_once( __DIR__ . '/classes/health-api-server.php');
    require_once( __DIR__ . '/classes/mamis-deployment-info.php');

    try {
        (new Mamis_Deployment_Info());
        (new Health_Api_Server());
    }
    catch (Exception $exception) {
        add_notice( __METHOD__ . ' error: ' . $exception->getMessage(), 'error' );
    }
}
?>
