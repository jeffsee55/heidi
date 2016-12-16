<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Core\Controller;
use Heidi\Core\AdminPanel;
use Heidi\Plugin\Models\SplashSettings;

class SplashPageController extends Controller
{
    public function registerSplashPage($templates)
    {
        $templates['splash-page-template.php'] = 'Splash Page';
        return $templates;
    }

    public function loadSplashPage( $template )
    {
        global $wp_query, $post;

        if($post)
        {

            $customTemplate = get_post_meta($post->ID, '_wp_page_template', true);

            if ( $customTemplate == 'splash-page-template.php' &&
                    file_exists(HEIDI_RESOURCE_PATH . 'views/templates/' . $customTemplate) )
            {

                $template = HEIDI_RESOURCE_PATH . 'views/templates/' . $customTemplate;

            }

        }

        return $template;
    }

    public function renderSplash()
    {
        global $post;

        return view('splash', compact('post'));
    }

    function addMetaBoxes()
    {
        global $post;

        $customTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($customTemplate === 'splash-page-template.php')
        {
            AdminPanel::addMetaBoxes(new SplashSettings, 'page', 'advanced');
        }
    }

    function addMultipart()
    {
        echo ' enctype="multipart/form-data"';
    }

    function enqueueScripts()
    {
        global $post;

        $customTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($customTemplate === 'splash-page-template.php')
        {

            wp_enqueue_script( 'q4vr_admin_settings' );

            wp_enqueue_script( 'q4vr_admin_media' );

            wp_enqueue_script( 'q4vr_admin_ajax' );

            wp_enqueue_style( 'q4vr_admin_settings' );

            wp_enqueue_media();

            wp_enqueue_script( 'common' );

            wp_enqueue_script( 'wp-lists' );

            wp_enqueue_script( 'postbox' );
        }

    }
}
