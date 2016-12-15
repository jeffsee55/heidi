<?php

namespace Heidi\Core;

use Heidi\Core\AdminPanelRow;

class AdminPanel
{
    public static function addMetaBoxes(BaseOption $class, String $screen, $context = 'normal')
    {
        // delete_user_meta( get_current_user_id(), 'meta-box-order_vacation_rental_page_q4-vr-settings');
        if(! empty($class->value)) {

            foreach($class->value as $index => $option)
            {

                add_meta_box(
                    $class->slug . '-' . $index,
                    $option['label'],
                    [new static(), 'render'],
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
                [new static(), 'render'],
                $screen,
                $context,
                'high'
            );

        }
    }

    public function render($post, $callback_args)
    {
        $option = $callback_args['args'][0];

        $index = $callback_args['args'][1];

        $panel = $this;

        $schema = $this->getSchema('q4vr_search_inputs');

        foreach($schema as $row)
        {

            $value = $option[$row->schema];

            $panel->rows[] = new AdminPanelRow($row, $value, $index);

        }

        view('core.admin_panel', compact('panel'));
    }

    private function getSchema($file)
    {
        $schema = file_get_contents(HEIDI_RESOURCE_DIR . 'schemas/' . $file . '.json');
        return json_decode($schema);
    }
}
