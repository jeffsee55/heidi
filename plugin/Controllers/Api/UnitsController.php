<?php

namespace Heidi\Plugin\Controllers\Api;

use Heidi\Core\Controller;
use Heidi\Plugin\Callbacks\Api\Search;
use Heidi\Plugin\Callbacks\Api\Unit;
use Heidi\Plugin\Models\VacationRental;

class UnitsController extends Controller
{
    public function searchApi($wp_query)
    {
        if($this->isSearchable($wp_query))
        {
            Search::run($wp_query);
        }
    }

    public function getUnit()
    {
        if($this->needsUnit($wp_query))
            Unit::get($wp_query);
    }

    public function addQueryVars()
    {
        add_filter('query_vars', [new Search, 'addQueryVars']);
    }

    public function addUnits()
    {
        if(! Search::$units)
            return;
            
        global $wp_query;

        $posts = $wp_query->get_posts();

        foreach(Search::$units as $unit)
        {

            $post = array_first($posts, function($index, $post) use ($unit) {

                return $post->post_title == $unit->unit_code;

            });

            $units[] = new VacationRental($post, $unit);
        }

        $wp_query->posts = $units;
    }

    public function loadMore()
    {}

    private function isSearchable($wp_query)
    {
        if(is_admin())
            return false;

        if(is_singular())
            return false;

        if(get_query_var('post_type') == 'vacation_rental')
            return true;
    }

    private function needsUnit($wp_query)
    {
        if(is_admin())
            return false;

        if(is_singular())
            return true;

        if(get_query_var('post_type') == 'vacation_rental')
            return true;
    }
}
