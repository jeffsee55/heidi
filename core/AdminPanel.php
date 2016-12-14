<?php

namespace Heidi\Core;

class AdminPanel
{
    public static function addMetaBoxes(BaseOption $class, String $screen, $context = 'normal')
    {
        foreach($class->list as $index => $listItem) {

            add_meta_box(
                $class->slug . '-' . $index,
                $class->name,
                [new static(), 'render'],
                $screen,
                $context,
                'high',
                $listItem
            );

        }
    }

    public function render($post, $listItem)
    {
        $panel = $listItem['args'];
        dd($panel);
        foreach($listItem['args']->options as $option)
        {
            $this->addRow($option);
        }
        $panel = $this;
        view('core.admin_panel', compact('panel'));
    }

    private function addRow($opion)
    {
        $this->rows[] = $option;
    }
}
