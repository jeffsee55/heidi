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

    public $value;

    public function __construct()
    {
        $this->list = get_option('q4vr_search_inputs');

        $this->name = 'General Information';

        $this->slug = 'general-information';

        $this->value = get_option('q4vr_search_inputs');
    }

    public function saveOptions()
    {
        $data = [];

        foreach($_POST['q4vr_search_inputs'] as $row)
        {

            $arguments = [];
            foreach($row['arguments'] as $index => $argument)
            {
                $key = $argument['key'];

                $value = $argument['value'];

                $arguments[$key] = $value;
            }
            $row['arguments'] = $arguments;

            $data[] = $row;
        }


        update_option('q4vr_search_inputs', $data);

        wp_redirect('http://plugintest.dev/wp-admin/edit.php?post_type=vacation_rental&page=q4vr-settings');

        exit();
    }

}
