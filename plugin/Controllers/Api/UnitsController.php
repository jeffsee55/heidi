<?php

namespace Heidi\Plugin\Controllers\Api;

use Heidi\Core\Controller;
use Heidi\Plugin\Callbacks\Api\Search;
use Heidi\Plugin\Callbacks\Api\Unit;

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
    {}

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
