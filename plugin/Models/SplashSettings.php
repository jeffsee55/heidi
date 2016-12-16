<?php

namespace Heidi\Plugin\Models;

use Heidi\Core\BaseOption;
/**
 * Class General Options.
 */
class SplashSettings extends BaseOption
{
    public $list;

    public $name;

    public $slug;

    public $value;

    public static $schema = 'q4vr_splash_settings';

    public function __construct()
    {
        $this->name = 'Splash Settings';

        $this->slug = 'splash-settings';

        $this->schema = self::$schema;

        $this->value = get_option(self::$schema);
    }

    public static function saveOptions()
    {
        dd($_GET);

        update_option(self::$schema, $_POST[self::$schema]);

        wp_redirect('http://plugintest.dev/wp-admin/post.php?post=2&action=edit');

        exit();
    }

}
