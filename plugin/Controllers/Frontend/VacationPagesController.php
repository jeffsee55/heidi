<?php

namespace Heidi\Plugin\Controllers\Frontend;

use Heidi\Core\Controller;

class VacationPagesController extends Controller
{
    public function renderSingle()
    {
        global $post;

        $unit = $post;

        return view('single', compact('unit'));
    }

    public function renderArchive()
    {
        global $posts;

        $units = $posts;

        return view('archive', compact('units'));
    }

    public function hideSidebar($sidbear)
    {
        if( is_singular( 'vacation_rental' ) || is_post_type_archive( 'vacation_rental' ) || is_page( 'booking' ) || is_page_template('filtered-search-template.php') ) {

            return false;

        } else {

            return $sidebar;

        }
    }

    public function addImages($images)
    {
        global $post;

        $unit = $post;

        return $unit->getImages();
    }
}
