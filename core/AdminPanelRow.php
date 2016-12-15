<?php

namespace Heidi\Core;

class AdminPanelRow
{
    public $name;

    public $option;

    public $type;

    public $value;

    public $arguments = [];

    public function __construct(Array $row, $value)
    {
        $this->name = $row['name'];

        $this->option = $row['option'];

        $this->type = $row['type'];

        $this->value = $value;

        $this->arguments = $row['arguments'];

        $this->argumentOptions = $row['argument_options'];
    }

    public function layout()
    {
        $row = $this;
        return view('core.admin_panel.' . $this->type . '_input', compact('row'));
    }
}
