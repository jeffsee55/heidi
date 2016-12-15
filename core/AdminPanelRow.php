<?php

namespace Heidi\Core;

class AdminPanelRow
{
    public $name;

    public $option;

    public $type;

    public $value;

    public $arguments = [];

    public $argumentOptions = [];

    public function __construct(\StdClass $row, $value, $index)
    {
        $this->name = $row->name;

        $this->option = $this->setOption($row->schema, $index);

        $this->type = $row->type;

        $this->value = $value;

        $this->class = $this->getClass($row, $value);

        $this->arguments = $row->arguments;

        $this->argumentOptions = $row->argument_options;
    }

    public function layout()
    {
        $row = $this;
        return view('core.admin_panel.' . $this->type . '_input', compact('row'));
    }

    public function setOption($schema, $index)
    {
        return "q4vr_search_inputs[{$index}][{$schema}]";
    }

    public function getClass($row, $value)
    {
        if($row->schema != 'arguments')
            return $row->schema;

        if(empty(array_filter($value)))
            return $row->schema . ' hidden';
    }
}
