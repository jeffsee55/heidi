<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Core\Controller;
use Heidi\Core\PostTypes;
use Heidi\Core\Taxonomies;
use Heidi\Plugin\Callbacks\Admin\VacationRentalPage;

class VacationRentalsController extends Controller
{
    protected $metaFields = [
        'unit_code' => 'Unit Code'
    ];

    function __construct()
    {
        add_action('add_meta_boxes_vacation_rental',  [$this, 'registerMetaBoxes']);
    }

    function registerPostType()
    {
        $config = [
            'description' => 'Vacation rentals booking engine',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'menu_icon' => 'dashicons-admin-home',
            'has_archive' => true,
            'rewrite' => ['slug' => 'vacation_rentals', 'with_front' => false],
            'capability_type' => 'post',
            'capabilities' => [
              'create_posts' => 'do_not_allow',
            ],
            'map_meta_cap' => true,
        ];
        PostTypes::addPostType( 'vacation_rental', $config, 'Vacation Rental', 'Vacation Rentals' );
    }

    function unregisterAccommodations()
    {
        unregister_post_type( 'accommodations' );
    }

    function registerTaxonomies()
    {
        $config = [
            'rewrite' => ['slug' => 'multiunits'],
            'hierarchical' => true,
        ];
        Taxonomies::add( 'multiunit', 'vacation_rental', $config, 'Multiunit', 'Multiunits' );

        $config = [
            'rewrite' => ['slug' => 'filters'],
            'hierarchical' => true,
        ];
        Taxonomies::add( 'filter', 'vacation_rental', $config, 'Filter', 'Filters' );
    }

    function registerMetaBoxes()
    {
        add_meta_box(
            'q4-vr-details',
            'API Details',
            [new VacationRentalPage, 'render'],
            null,
            'side',
            'default',
            $this->metaFields
        );
    }

    public function loadTemplates( $template )
    {
        global $wp_query, $post;

        $post_type = 'vacation_rental';

        if ( is_post_type_archive( $post_type ) &&
                ! file_exists( get_stylesheet_directory() . '/archive-vacation_rental.php' ) )
        {

            $template = HEIDI_RESOURCE_PATH . 'views/templates/archive-vacation_rental.php';

        } elseif ( is_singular( $post_type ) &&
                ! file_exists( get_stylesheet_directory() . '/single-vacation_rental.php' ) )
        {

            $template = HEIDI_RESOURCE_PATH . 'views/templates/single-vacation_rental.php';

        }

        return $template;
    }

    public function renderSingle()
    {
        global $post;

        return view('single', compact('post'));
    }

    public function renderArchive()
    {
        global $post;

        return view('archive', compact('post'));
    }

}
