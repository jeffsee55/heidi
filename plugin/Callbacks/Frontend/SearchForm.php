<?php

namespace Heidi\Plugin\Callbacks\Frontend;

use Heidi\Plugin\Models\SearchItem;

class SearchForm
{
    public $settings;

    public $layout;

    public $items;

    public $wrapperClass;

    public $innerClass;

    public $callType;

    public $formAction;

    public $action;

    public $unitCode;

    public static function render($layout)
    {
        new static($layout);
    }

    public function __construct($layout)
    {
        $this->settings = get_option('q4vr_search_settings');

        $this->layout = $layout;

        $this->setFormVars($layout);

        $this->buildItems();

        $this->renderItems();
    }

    protected function buildItems()
    {
        foreach($this->settings as $searchItem)
        {
            $this->items[] = new SearchItem($searchItem, $this->layout);
        }
    }

    protected function renderItems()
    {
        $regularItems = $this->getRegularItems();

        $advancedItems = $this->getAdvancedItems();

        view('searchform', ['searchForm' => $this]);
    }

    protected function getRegularItems()
    {
        $this->regularItems = array_filter($this->items, function($item) {
            return ! $item->advanced;
        });
    }

    protected function getAdvancedItems()
    {
        $this->advancedItems = array_filter($this->items, function($item) {

            return $item->advanced;

        });
    }

    protected function setFormVars($layout)
    {
        $vars = [
            'universal' => [
                'wrapperClass' => 'container universal-search',
                'innerClass' => 'inner-container center-block',
                'callType' => null,
                'formAction' => '/vacation_rentals',
                'action' => null,
                'unitCode' => null
            ]
        ];

        $this->wrapperClass = $vars[$layout]['wrapperClass'];

        $this->innerClass = $vars[$layout]['innerClass'];

        $this->callType = $vars[$layout]['callType'];

        $this->formAction = $vars[$layout]['formAction'];

        $this->action = $vars[$layout]['action'];

        $this->unitCode = $vars[$layout]['unitCode'];
    }
}
