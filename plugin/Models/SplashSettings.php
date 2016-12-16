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
        global $post;

        $this->name = 'Splash Settings';

        $this->slug = 'splash-settings';

        $this->schema = self::$schema;

        $this->value = get_post_meta($post->ID, self::$schema, true);
    }

    public static function saveMeta($post_id)
    {
        update_post_meta($post_id, self::$schema, $_POST[self::$schema]);
    }

}
