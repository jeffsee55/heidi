<?php

namespace Heidi\Plugin\Models;

use Heidi\Core\BaseOption;
/**
 * Class General Options.
 */
class ApiSettings extends BaseOption
{
    public $list;

    public $name;

    public $slug;

    public $value;

    public static $schema = 'q4vr_api_settings';

    public function __construct()
    {
        $this->name = 'API Settings';

        $this->slug = 'api-settings';

        $this->schema = self::$schema;

        $this->value = get_option(self::$schema);
    }

    public static function saveOptions()
    {
        update_option(self::$schema, $_POST[self::$schema]);

        wp_redirect('http://plugintest.dev/wp-admin/edit.php?post_type=vacation_rental&page=q4vr-settings');

        exit();
    }

}
