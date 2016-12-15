<?php

return [
    'title' => 'Search Input',
    'options' => [
        [
            'name' => 'Label',
            'option' => 'q4vr_search_inputs['. $index .'][label]',
            'value' => isset($searchInput['label']) ? $searchInput['label'] : '',
            'type' => 'text',
            'schema' => 'label'
        ],
        [
            'name' => 'Show Label',
            'option' => 'q4vr_search_inputs['. $index .'][show_label]',
            'value' => isset($searchInput['show_label']) ? $searchInput['show_label'] : 1,
            'type' => 'select',
            'schema' => 'show_label',
            'arguments' => [
                0 => 'Don\'t show label',
                1 => 'Show label',
            ]
        ],
        [
            'name' => 'Name',
            'option' => 'q4vr_search_inputs[' . $index . '][name]',
            'value' => isset($searchInput['name']) ? $searchInput['name'] : '',
            'schema' => 'name',
            'type' => 'text'
        ],
        [
            'name' => 'Input Type',
            'option' => 'q4vr_search_inputs[' . $index . '][input_type]',
            'type' => 'select',
            'schema' => 'input_type',
            'value' => isset($searchInput['input_type']) ? $searchInput['input_type'] : '',
            'arguments' => [
                'text' => 'Text',
                'select' => 'Select',
                'checkbox' => 'Checkbox',
                'calendar' => 'Calendar',
                'link' => 'Link',
                'widget' => 'Widget Area',
                'button' => 'Button',
                'filter' => 'Extra Search Categories'
            ]
        ],
        [
            'name' => 'Arguments',
            'option' => 'q4vr_search_inputs[' . $index . '][arguments]',
            'type' => 'multi',
            'schema' => 'arguments',
            'value' => isset($searchInput['arguments']) ? $searchInput['arguments'] : '',
        ],
        [
            'name' => 'Advanced',
            'option' => 'q4vr_search_inputs[' . $index . '][advanced]',
            'type' => 'select',
            'schema' => 'advanced',
            'value' => isset($searchInput['advanced']) ? $searchInput['advanced'] : '',
            'arguments' => [
                0 => 'Show in regular form',
                1 => 'Show in advanced fields'
            ]
        ],
        [
            'name' => 'Layouts',
            'option' => 'q4vr_search_inputs[' . $index . '][layouts]',
            'type' => 'checkbox',
            'schema' => 'layouts',
            'value' => isset($searchInput['layouts']) ? $searchInput['layouts'] : '',
            'arguments' => [
                'universal' => 'Navigation search form',
                'shortcode' => 'Shortcode search form',
                'single' => 'Single unit search form',
                'multunit' => 'Multiunit search form',
            ],
            'argument_options' => [
                [
                    'name' => 'Large',
                    'option' => 'large',
                    'type' => 'select',
                    'value' => 3,
                    'arguments' => array_combine(range(1,12), range(1,12))
                ],
                [
                    'name' => 'Medium',
                    'option' => 'medium',
                    'type' => 'select',
                    'value' => 6,
                    'arguments' => array_combine(range(1,12), range(1,12))
                ],
                [
                    'name' => 'Small',
                    'option' => 'small',
                    'type' => 'select',
                    'value' => 12,
                    'arguments' => array_combine(range(1,12), range(1,12))
                ],
                [
                    'name' => 'X-Small',
                    'option' => 'x-small',
                    'type' => 'select',
                    'value' => 12,
                    'arguments' => array_combine(range(1,12), range(1,12))
                ]
            ]
        ]
    ]
];
