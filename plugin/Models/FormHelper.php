<?php

namespace Heidi\Plugin\Models;

class FormHelper
{
    public static function render($searchItem)
    {
        $html = '<div class="col-xs-' . $searchItem->x_small . ' col-sm-' . $searchItem->small . ' col-md-' . $searchItem->medium . ' col-lg-' . $searchItem->large . '">';

            $inputType = $searchItem->inputType;
            $html .= self::$inputType($searchItem);

        $html .= '</div>';

        return $html;
    }

    public static function button($searchItem)
    {
        return "<button id='searchSubmit' class='btn btn-block btn-primary'>{$searchItem->label}</button>";
    }

    static function link($searchItem)
    {
        return "<a class='form-control form-group' id='advancedSearchButton' data-toggle='collapse' href='#advancedSearch' aria-expanded='false' aria-controls='advancedSearch'>{$searchItem->label}</a>";
    }

    static function text($searchItem)
    {
        return "<input id={$searchItem->name} class='form-control form-group' type='text' name={$searchItem->name} value={$searchItem->value} placeholder={$searchItem->placeholder}>";
    }

    static function select($searchItem)
    {
        $html = '';
        if($searchItem->show_label)
            $html .= '<label>' . $searchItem->label . '</label>';
        $html .= "<select data-query_var={$searchItem->name} id={$searchItem->name} name={$searchItem->name} class='form-control form-group'>";
        $html .= "<option value=''>$searchItem->label</option>";
        foreach($searchItem->arguments as $value => $displayName)
        {
            $selected = $searchItem->value == $value ? 'selected' : '';
            $html .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $displayName);
        }
        $html .= '</select>';

        return $html;
    }

    static function checkbox($searchItem)
    {
        $html = '';
        if($searchItem->show_label)
            $html .= '<label>' . $searchItem->label . '</label>';
        foreach($searchItem->arguments as $value => $displayName)
        {
            $selected = in_array($value, (array) $searchItem->value) ? 'checked' : '';
            $html .= sprintf('<div class="checkbox"><label><input data-query_var="%s" type="checkbox" name="%s[]" %s value="%s">%s</label></div>', $searchItem->name, $searchItem->name, $selected, $value, $displayName);
        }
        return $html;
    }

    static function calendar($searchItem)
    {
        return '<div class="form-control form-group" id="dates"></div>';
    }

    static function filter($searchItem)
    {
        $terms = get_terms( array(
            'taxonomy' => $searchItem['name'],
            'hide_empty' => false,
        ) );
        foreach($terms as $term)
        {
            $arguments[$term->slug] = $term->name;
        }
        $searchItem['arguments'] = $arguments;
        return self::checkbox($searchItem, $layout);
    }

    static function widget($searchItem)
    {
        $html = '';
        if($searchItem->show_label)
            $html .= '<label>' . $searchItem->label . '</label>';
        if ( is_active_sidebar( 'advanced_search_widget' ) ) :
            ob_start();
            	dynamic_sidebar( 'advanced_search_widget' );
            $html .= ob_get_clean();
        else :
            $html .= '<h3>No Widget Found</h3><p>Be sure to add a widget in the Advanced Search Widget area from the customizer</p>';
        endif;
        return $html;
    }
}
