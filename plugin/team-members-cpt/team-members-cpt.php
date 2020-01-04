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
        add_action( 'add_meta_boxes', array($this, 'add_your_fields_meta_box') );
        add_action( 'save_post', array($this, 'save_your_fields_meta') );
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

        /*
        function add_custom_meta_boxes() {
            $this->
        }
*/
/*
        function create_single_meta_box() {
            add_meta_box(
                'your_fields_meta_box', // $id
                'Your Fields', // $title
                array($this, 'show_your_fields_meta_box'), // $callback
                'team_members', // $screen
                'normal', // $context
                'high' // $priority
            );
        }*/

        function add_your_fields_meta_box() {
            add_meta_box(
                'your_fields_meta_box', // $id
                'Your Fields', // $title
                array($this, 'show_your_fields_meta_box'), // $callback
                'team_members', // $screen
                'normal', // $context
                'high' // $priority
            );
        }

        function show_your_fields_meta_box() {
            global $post;
                $meta = get_post_meta( $post->ID, 'your_fields', true );
            ?>
    
            <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

            <div style="margin-top: 5px;">
                <h3 style="margin: 0; margin-bottom: 5px;">
    	            <label for="your_fields[email]">Peronal Email</label>
                </h3>
    	        <input type="email" name="your_fields[email]" id="your_fields[email]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['email'])){ echo $meta['email']; } ?>">
            </div> 
            <div style="margin-top: 5px;">
                <h3 style="margin: 0; margin-bottom: 5px;">
    	            <label for="your_fields[facebook]">Facebook</label>
                </h3>
    	        <input type="text" name="your_fields[facebook]" id="your_fields[facebook]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['facebook'])){ echo $meta['facebook']; } ?>">
            </div>
            <div style="margin-top: 5px;">
                <h3 style="margin: 0; margin-bottom: 5px;">
                    <label for="your_fields[instagram]">Instagram</label>
                </h3>
    	        <input type="text" name="your_fields[instagram]" id="your_fields[instagram]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['instagram'])){ echo $meta['instagram']; } ?>">
            </div>
            <div style="margin-top: 5px;">
                <h3 style="margin: 0; margin-bottom: 5px;">
    	            <label for="your_fields[linkedin]">LinkedIn</label>
                </h3>
    	        <input type="text" name="your_fields[linkedin]" id="your_fields[linkedin]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['linkedin'])){ echo $meta['linkedin']; } ?>">
            </div>
            <?php 
        }

        function save_your_fields_meta( $post_id ) {
            // verify nonce
            if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
                return $post_id;
            }
            // check autosave
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
            // check permissions
            if ( 'page' === $_POST['post_type'] ) {
                if ( !current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }
            }
    
            $old = get_post_meta( $post_id, 'your_fields', true );
            $new = $_POST['your_fields'];


            var_dump($new);
    
            if ( $new && $new !== $old ) {
                update_post_meta( $post_id, 'your_fields', $new );
            } elseif ( '' === $new && $old ) {
                delete_post_meta( $post_id, 'your_fields', $old );
            }
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