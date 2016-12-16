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
        AdminPanel::addMetaBoxes(new SplashSettings, 'page', 'advanced');
    }
}
