<?php

namespace Heidi\Plugin\Models;

use Heidi\Core\BaseOption;
/**
 * Class General Options.
 */
class GeneralSettings extends BaseOption
{
    public $list;

    public $name;

    public $slug;

    public $value;

    public static $schema = 'q4vr_general_settings';

    public function __construct()
    {
        $schema = 'q4vr_general_settings';

        $this->list = get_option($schema);

        $this->name = 'General Information';

        $this->slug = 'general-information';

        $this->schema = $schema;

        $this->value = get_option($schema);
    }

    public static function saveOptions()
    {
        update_option(self::$schema, $_POST);

        wp_redirect('http://plugintest.dev/wp-admin/edit.php?post_type=vacation_rental&page=q4vr-settings');

        exit();
    }

}
