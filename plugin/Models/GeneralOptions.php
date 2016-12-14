<?php

namespace Heidi\Plugin\Models;

use Heidi\Core\BaseOption;
/**
 * Class General Options.
 */
class GeneralOptions extends BaseOption
{
    public $list;

    public $name;

    public $slug;

    public function __construct()
    {
        $this->list = get_option('q4vr_search_inputs');

        $this->name = 'General Information';

        $this->slug = 'general-information';
    }

}
