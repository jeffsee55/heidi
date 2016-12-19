<?php

namespace Heidi\Plugin\Models;

use Heidi\Plugin\Models\FormHelper;

class SearchItem
{
    public $label;

    public $showLabel;

    public $name;

    public $inputType;

    public $arguments;

    public $advanced;

    public $large;

    public $medium;

    public $small;

    public $x_small;

    public $value;

    public function __construct($searchItem, $layout)
    {
        $this->label = $searchItem['label'];

        $this->showLabel = !! $searchItem['show_label'];

        $this->name = $searchItem['name'];

        $this->inputType = $searchItem['input_type'];

        $this->arguments = array_filter($searchItem['arguments']);

        $this->advanced = !! $searchItem['advanced'];

        $this->value = $this->getValue();

        foreach($searchItem['layouts'][$layout] as $key => $columns)
        {
            $this->$key = $columns;
        }
    }

    public function render()
    {
        return FormHelper::render($this);
    }

    public function getValue()
    {
        $value = get_query_var($this->name);

        if(is_array($value))
        {
            return array_map(function($item) {

                return urldecode($item);

            }, $value);
        }

        return urldecode($value);
    }
}
