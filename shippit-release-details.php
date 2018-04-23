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

add_action( 'wp_footer', 'shippit_content_footer_details');
add_filter('update_footer', 'shippit_content_footer_details');
add_filter('admin_footer_text', 'remove_footer_text');
add_action('init', 'deploymentinfo_init_assets');

function deploymentinfo_init_assets()
{
    wp_register_style(
        'mamis-deploymentinfo',
        plugins_url('mamis-deployment-info/styles.css')
    );

    if (current_user_can('administrator')) {
        wp_enqueue_style('mamis-deploymentinfo');
    }
}

// Remove admin footer thank you text
function remove_footer_text()
{
    return '';
}

function getReleaseName()
{
    return trim(
        basename(
            ABSPATH
        )
    );
}

// Add release details to footer
function shippit_content_footer_details() {
    if (!current_user_can('administrator')) {
        return;
    }

    echo '<div class="release-details">';
    echo '<span class="release"><b>Release</b> ' . getReleaseName() . '</span>';
    echo '<span class="separator">|</span>';
    echo '<span class="host"><b>Host</b> ' . gethostname() . '</span>';
    echo '</div>';
}
