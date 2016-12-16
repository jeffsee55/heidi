<?php

namespace Heidi\Plugin\Models;

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

	public function __construct( $post = null, $unit) {
		if ( is_integer( $post ) ) {

			$this->ID = $post;

			$this->init();

		} elseif ( is_a( $post, '\WP_Post' ) ) {

			$this->import( $post );

		}

        $this->importUnit($unit);
	}

    public function importUnit($unit)
    {
        $attributes = get_object_vars($this);
        foreach((array) $unit as $attribute => $value)
        {
            $this->$attribute = $value;
        }
	}
}
