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

function view($name, $data = [])
{
    extract($data);

    return require "views/{$name}.blade.php";
}
