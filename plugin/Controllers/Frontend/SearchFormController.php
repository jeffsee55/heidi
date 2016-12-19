<?php

namespace Heidi\Plugin\Controllers\Frontend;

use Heidi\Core\Controller;
use Heidi\Plugin\Callbacks\Frontend\SearchForm;

class SearchFormController extends Controller
{
    private function render()
    {
    }

    public function renderIndexSearch()
    {
        SearchForm::render('universal');
    }
}
