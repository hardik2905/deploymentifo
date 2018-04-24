<?php

class Mamis_Deployment_Info
{
    public function __construct()
    {
        $this->register_hook_callbacks();
    }

    public function register_hook_callbacks()
    {
        if (!current_user_can('administrator')) {
            return;
        }

        add_action( 'wp_enqueue_scripts', __CLASS__ . '::load_resources');
        add_action( 'admin_enqueue_scripts', __CLASS__ . '::load_resources');
        add_action( 'wp_footer', array($this, 'add_mamis_deployment_details'));
        add_filter('update_footer', array($this, 'add_mamis_deployment_details'));
    }

    public static function load_resources() {
        wp_register_style(
            'mamis-deploymentinfo',
            plugins_url('css/styles.css', dirname( __FILE__ ))
        );

        wp_enqueue_style('mamis-deploymentinfo');
    }

    // Add release details to footer
    public function add_mamis_deployment_details() {
        echo '<div class="release-details">';
        echo '<span class="release"><b>Release</b> ' . self::getReleaseName() . '</span>';
        echo '<span class="separator">|</span>';
        echo '<span class="host"><b>Host</b> ' . gethostname() . '</span>';
        echo '</div>';
    }

    public static function getReleaseName()
    {
        return trim(
            basename(
                ABSPATH
            )
        );
    }
}
