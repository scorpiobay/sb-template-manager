<?php
/**
 * custom_post_type
 *
 * Setup of the Wordpress Custom Post Type
 *
 * @access public
 * @return void
 */

class AST_CPT{
   
    function ast_custom_post_type() {
        $defines = new Defines();

        $labels = array(
            'name'                  => _x( $defines::AST_CPT_PLURAL, 'Post Type General Name' ),
            'singular_name'         => _x( $defines::AST_CPT_SINGLE, 'Post Type Singular Name' ),
            'menu_name'             => __( $defines::AST_CPT_PLURAL ),
            'name_admin_bar'        => __( $defines::AST_CPT_PLURAL ),
            'archives'              => __( $defines::AST_CPT_SINGLE . ' Archives' ),
            'parent_item_colon'     => __( 'Parent Item:' ),
            'all_items'             => __( 'All ' . $defines::AST_CPT_PLURAL  ),
            'add_new_item'          => __( 'Add New ' .$defines::AST_CPT_SINGLE ),
            'add_new'               => __( 'Add New ' .$defines::AST_CPT_SINGLE ),
            'new_item'              => __( 'New ' .$defines::AST_CPT_SINGLE ),
            'edit_item'             => __( 'Edit ' .$defines::AST_CPT_SINGLE ),
            'update_item'           => __( 'Update ' .$defines::AST_CPT_SINGLE ),
            'view_item'             => __( 'View ' .$defines::AST_CPT_SINGLE  ),
            'search_items'          => __( 'Search ' .$defines::AST_CPT_SINGLE  ),
            'not_found'             => __( 'Not found' ),
            'not_found_in_trash'    => __( 'Not found in Trash' ),
            'featured_image'        => __( 'Featured Image' ),
            'set_featured_image'    => __( 'Set featured image' ),
            'remove_featured_image' => __( 'Remove featured image' ),
            'use_featured_image'    => __( 'Use as featured image' ),
            'insert_into_item'      => __( 'Insert into ' .$defines::AST_CPT_SINGLE  ),
            'uploaded_to_this_item' => __( 'Uploaded to this item' ),
            'items_list'            => __( $defines::AST_CPT_PLURAL . ' list' ),
            'items_list_navigation' => __( 'Items list navigation' ),
            'filter_items_list'     => __( 'Filter items list' ),
        );

        $rewrite = array(
            'slug'                  => $defines::AST_CPT,
            'with_front'            => false,
            'pages'                 => false,
            'feeds'                 => false,
        );

        $args = array(
            'label'                 => __( $defines::AST_CPT_SINGLE ),
            'description'           => __( 'Custom ' . $defines::AST_CPT_PLURAL ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-lightbulb',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
            'register_meta_box_cb'  => array('AST_CPT', 'ast_add_metaboxes')
        );

        register_post_type( $defines::AST_CPT, $args );
    }
}
add_action( 'init', array('AST_CPT','ast_custom_post_type' ) );
add_shortcode( 'ast-cpt', array('AST_CPT','ast_shortcode' ));