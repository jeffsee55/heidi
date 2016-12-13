<?php

require_once( __DIR__ . '/vendor/autoload.php' );

function getPlugin()
{
    return Heidi\Plugin\Plugin::getInstance();
}

function dump($item)
{
    echo '<pre>';

    var_dump($item);

    echo '</pre>';
}

function dd($item)
{
    echo '<pre>';

    var_dump($item);

    echo '</pre>';

    exit();
}

use Windwalker\Renderer\BladeRenderer;

function view($name, $data = [])
{

    $paths = [HEIDI_PLUGIN_PATH . 'views/'];

    $renderer = new BladeRenderer($paths, array('cache_path' => __DIR__ . '/cache'));

    echo $renderer->render('admin_settings', $data);
}
