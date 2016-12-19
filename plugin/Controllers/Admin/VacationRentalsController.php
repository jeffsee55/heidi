<?php

namespace Heidi\Plugin\Controllers\Admin;

use Heidi\Core\Controller;
use Heidi\Core\PostTypes;
use Heidi\Core\Taxonomies;
use Heidi\Plugin\Callbacks\Admin\VacationRentalPage;

class VacationRentalsController extends Controller
{
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
            'default'
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
        global $posts;

        $units = $posts;

        return view('archive', compact('units'));
    }

    public function saveMeta($post_id) {

        // prevent quickedit from remove meta fields
        if(! isset($_POST['_inline_edit']))
            return;

        if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
            return;

        update_post_meta( $post_id, 'unit_code', $_POST['unit_code'] );
    }

    public function importUnits()
    {
        $this->deleteExistingUnits();

        $unitCodes = $_POST['unit_codes'];

        array_map(function($unitCode) {

            $args = [
                'post_title' => $unitCode,
                'post_type' => 'vacation_rental',
                'post_status' => 'publish',
                'meta_input' => [
                    'unit_code' => $unitCode
                ]
            ];

            wp_insert_post($args);

        }, $unitCodes);

        wp_redirect('/wp-admin/edit.php?post_type=vacation_rental');

        exit();
    }

    public function deleteExistingUnits()
    {
        $query = new \WP_Query(['post_type' => 'vacation_rental', 'posts_per_page' => -1]);

        array_map(function($post) {

            wp_delete_post($post->ID, true);

        }, $query->get_posts());
    }
}
