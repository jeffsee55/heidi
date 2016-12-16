<?php

namespace Heidi\Plugin\Controllers\Api;

use Heidi\Core\Controller;
use Heidi\Plugin\Callbacks\Api\Stay;
use Heidi\Plugin\Callbacks\Api\Search;

class StayController extends Controller
{
    public function ajaxGetStay()
    {
        Stay::get();
    }
}
