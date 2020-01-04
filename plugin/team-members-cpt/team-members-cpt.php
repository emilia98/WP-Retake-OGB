<?php

/*
    Plugin Name: Team Members Custom Post Type
    Plugin URI: N/A
    description: A plugin for creating a custom post type for managing team members
    Version: 0.0.1
    Author: Emilia Nedyalkova
    Author URI: N/A
    License: GPL2
*/


if(!defined('ABSPATH')) {
    exit;
}

class TeamMembersCPT {

    function __construct() {
        add_action('init', array($this, 'custom_post_type'));
        add_action('init', array($this, 'custom_taxonomy') );
    }

    function activate() {
        // generate a CPT
        $this->custom_post_type();
        $this->custom_taxonomy();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function deactivate() {
        // flush rewrite rules
        flush_rewrite_rules();
    }

    function uninstall() {
        // delete CPT
        // delete all the plugin data from DB
    }

    function custom_post_type() {
        // register_post_type('team_member');

        $labels = array(
            'name'                => _x( 'Team Members', 'Post Type General Name', 'text_domain' ),
            'singular_name'       => _x( 'Team Member', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'           => __( 'Team Members', 'text_domain' ),
            //'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
            'all_items'           => __( 'All Members', 'text_domain' ),
            'view_item'           => __( 'View Members', 'text_domain' ),
            'add_new_item'        => __( 'Add New Member', 'text_domain' ),
            'add_new'             => __( 'Add New', 'text_domain' ),
            'edit_item'           => __( 'Edit Member', 'text_domain' ),
            'update_item'         => __( 'Update Member', 'text_domain' ),
            'search_items'        => __( 'Search Member', 'text_domain' ),
            'not_found'           => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
        );
        $args = array(
            'label'               => __( 'Team Members', 'text_domain' ),
            'description'         => __( 'Post Type Description', 'text_domain' ),
            'labels'              => $labels,
            'supports'            =>array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
            'taxonomies'          => array( 'positions'),
            'rewrite' => array('slug' => 'team_members'),
            'hierarchical'        => true,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 30,
            'menu_icon'           => 'dashicons-id',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
        );
        
        register_post_type( 'team_members', $args );

       // $this->custom_taxonomy();
    }

    function custom_taxonomy() {
 
        // Labels part for the GUI
         
          $labels = array(
            'name' => _x( 'Positions', 'taxonomy general name' ),
            'singular_name' => _x( 'Position', 'taxonomy singular name' ),
            'search_items' =>  __( 'Search Positions' ),
            'popular_items' => __( 'Popular Positions' ),
            'all_items' => __( 'All Positions' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Position' ), 
            'update_item' => __( 'Update Position' ),
            'add_new_item' => __( 'Add New Position' ),
            'new_item_name' => __( 'New Position Name' ),
            'separate_items_with_commas' => __( 'Separate positions with commas' ),
            'add_or_remove_items' => __( 'Add or remove positions' ),
            'choose_from_most_used' => __( 'Choose from the most used positions' ),
            'menu_name' => __( 'Positions' ),
          ); 
         
        // Now register the non-hierarchical taxonomy like tag
         
          register_taxonomy('positions',array('team_members'),array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'team_positions' ),
          ));
        }
}

if(class_exists('TeamMembersCPT')) {
    $teamMembersCPT = new TeamMembersCPT();
}

// activation
register_activation_hook( __FILE__, array($teamMembersCPT, 'activate'));

// deactivation
register_deactivation_hook( __FILE__, array($teamMembersCPT, 'deactivate'));

// uninstall