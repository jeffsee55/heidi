<?php

namespace Heidi\Core;

use Heidi\Core\AdminPanelRow;

class AdminPanel
{
    public $schema;

    public function __construct(String $schema)
    {
        $this->schema = $schema;
    }

    public static function addMetaBoxes(BaseOption $class, String $screen, $context = 'normal')
    {
        if(! empty($class->value)) {

            foreach($class->value as $index => $option)
            {

                add_meta_box(
                    $class->slug . '-' . $index,
                    $option['label'],
                    [new static($class->schema), 'render'],
                    $screen,
                    $context,
                    'high',
                    [$option, $index]
                );

            }

        } else {

            add_meta_box(
                $class->slug . '-0',
                $class->name,
                [new static($class->schema), 'render'],
                $screen,
                $context,
                'high',
                [null, 0]
            );

        }
    }

    public function render($post, Array $callback_args)
    {
        $option = $callback_args['args'][0];

        $index = $callback_args['args'][1];

        $panel = $this;

        $schema = $this->getSchema($this->schema);

        foreach($schema as $row)
        {

            $value = $option[$row->schema];

            $panel->rows[] = new AdminPanelRow($row, $value, $index, $this->schema);

        }

        view('core.admin_panel', compact('panel'));
    }

    private function getSchema(String $file)
    {
        $schema = file_get_contents(HEIDI_RESOURCE_DIR . 'schemas/' . $file . '.json');

        return json_decode($schema);
    }
}
