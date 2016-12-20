<?php

namespace Heidi\Plugin\Controllers\Frontend;

use Heidi\Core\Controller;
use Heidi\Plugin\Callbacks\Frontend\SearchForm;

class SearchFormController extends Controller
{
    private function render()
    {}

    public function renderIndexSearch()
    {
        if(is_singular('vacation_rental'))
            return;
            
        SearchForm::render('universal');
    }

    public function enqueueScripts()
    {
        wp_enqueue_script('q4vr_searchform', HEIDI_RESOURCE_DIR . 'dist/js/bundle.js', [], HEIDI_VERSION, true);
        wp_enqueue_style( 'q4vr', HEIDI_RESOURCE_DIR . 'dist/css/main.css', [], HEIDI_VERSION);
    }
}
