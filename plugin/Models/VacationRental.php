<?php

namespace Heidi\Plugin\Models;

use Heidi\Plugin\Callbacks\Frontend\SearchForm;

/**
 * Class VacationRental
 */
class VacationRental extends Post
{
    public $unit_code;

    public $headline;

    public $description;

    public $default_image_url;

    public $rooms;

    public $address;

    public $amenities;

    public $rate;

    public $max_occupancy;

    public $position;

    public $media;

    public $policies;

    public $reviews;

    public $directionsUrl;

    public $mapUrl;

	public function __construct( $post = null, $unit) {
		if ( is_integer( $post ) ) {

			$this->ID = $post;

			$this->init();

		} elseif ( is_a( $post, '\WP_Post' ) ) {

			$this->import( $post );

		}

        $this->importUnit($unit);

        $this->description = $unit->descriptions->long_description;

        $this->setDirectionLinks();
	}

    public function importUnit($unit)
    {
        $attributes = get_object_vars($this);

        foreach((array) $unit as $attribute => $value)
        {
            $this->$attribute = $value;
        }
	}

    function getImage()
    {
        return $this->default_image_url;
    }

    function displayRate()
    {
        return 'FROM $' . number_format(floatval($this->rate->base_rate), 0);
    }

    function getBedrooms()
    {
        return '3';
    }

    function getBathrooms()
    {
        return '4';
    }

    function getImages()
    {
        return $this->media->images;
    }

    function getSearchForm()
    {
        $searchForm = new SearchForm('single');

        $searchForm->unitCode = $this->unit_code;

        $searchForm->formAction = null;

        $searchForm->action = 'q4vr_stay';
        
        $searchForm->callType = 'q4_vr_search_form_ajax';

        return $searchForm;
    }

    function setDirectionLinks()
    {
        if( $this->position->show ) {
            $embedUrl = sprintf('https://www.google.com/maps/embed/v1/view?key=%s&center=%s,%s&zoom=15',
                'AIzaSyDqfmmMfRO4WVh0smBZ7wbE2KvJYVzDAkA',
                $this->position->lat,
                $this->position->lon
            );
        }

        $this->directionsUrl = 'http://www.google.com/maps/place/' . $this->position->lat . ',' . $this->position->lon;

        $this->mapUrl = $embedUrl;
    }
}
