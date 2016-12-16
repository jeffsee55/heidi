<?php

namespace Heidi\Plugin\Models;

use Heidi\Core\BaseOption;
/**
 * Class General Options.
 */
class SearchSettings extends BaseOption
{
    public $list;

    public $name;

    public $slug;

    public $value;

    public static $schema = 'q4vr_search_settings';

    public function __construct()
    {
        $this->name = 'Search Settings';

        $this->slug = 'search-settings';

        $this->schema = self::$schema;

        $this->value = get_option(self::$schema);
    }

    public static function saveOptions()
    {
        $data = [];

        foreach($_POST[self::$schema] as $row)
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


        update_option(self::$schema, $data);

        wp_redirect('http://plugintest.dev/wp-admin/edit.php?post_type=vacation_rental&page=q4vr-settings');

        exit();
    }

}
