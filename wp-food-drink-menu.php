<?php 
	/*
    Plugin Name: WP Food & Drink Menu
    Plugin URI: http://www.averykushner.com
    Description: A sleek, customizable menu for shops and businesses
    Author: Avery Kushner
    Version: 1.0
    Author URI: http://www.averykushner.com
    */

    /*
    *
    * Intitialize global variables
    *
    */

    $options = array();
    $size_prices = array();

    function awesome_page_create(){

        $page_title = 'Food & Drink Menu';
        $menu_title = 'Food & Drink Menu';
        $capability = 'edit_posts';// edit_posts may allow custom post integration
        $menu_slug = 'wp-food-drink-menu';
        $function = 'wp_food_drink_menu_options_page';
        $icon_url = '';
        $position = 15;

        add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        // add_submenu_page( 'edit.php?post_type=food_drink_menu_item', 'Genre', 'Genre', 'manage_options' );
    }

    add_action('admin_menu', 'awesome_page_create');

    //Creates options page
    function wp_food_drink_menu_options_page(){

    	//Check for sufficient user permissions
    	if( !current_user_can( 'manage_options' ) ){

    		wp_die( 'Sorry, you do not have sufficient permissions' );

    	}

        //define options var
        global $options;

        // process number of sizes data data:
        if( isset($_POST['wp-food-drink_num_sizes_form_submitted']) ){

            $hidden_field = esc_html( $_POST['wp-food-drink_num_sizes_form_submitted'] );
            if( $hidden_field == 'Y' ){

                $num_sizes = esc_html( $_POST['wp-food-drink_num_sizes'] );

                // echo 'Num sizes var: ';
                // var_dump($num_sizes);

                $options['wp-food-drink_num_sizes'] = $num_sizes;
                // update_option will check to see if the option already exists. 
                // If it does not, it will be added 
                update_option( 'num_sizes', $options );

            }  

        } 

        if( isset($_POST['wp-food-drink_add_size_type_form_submitted']) ){

            $hidden_field1 = esc_html( $_POST['wp-food-drink_add_size_type_form_submitted'] );

            if( $hidden_field1 == 'Y' ){

                $sizes = array_fill( 0, 1, '' );

                $i = 0;
                while( esc_html($_POST['wp-food-drink_size_name_' . $i]) != null ){

                    // echo '<p>' . 'Size: ' . esc_html($_POST['wp-food-drink_size_name_' . $i]) . '</p>';
                    $sizes[$i] = esc_html( $_POST['wp-food-drink_size_name_' . $i] );
                    $i+=1;
                    // echo 'Here is size ' . $i . ': ' . $sizes[$i];

                }

                $options['wp-food-drink_sizes'] = $sizes;
                // update_option will check to see if the option already exists. 
                // If it does not, it will be added 
                update_option( 'size_type', $options );

            }

        }

        $options = get_option( 'num_sizes' );

        if( $options['wp-food-drink_num_sizes'] != '' ){

            $num_sizes = $options['wp-food-drink_num_sizes'];
            // var_dump($options['wp-food-drink_num_sizes']);

        }

        $options = get_option( 'size_type' );

        if( $options['wp-food-drink_sizes'] != '' ){

            $sizes = $options['wp-food-drink_sizes'];
            // echo 'I am in the size type if';
            // echo 'Here is size 1: ' . $sizes[0];

        }

    	require( 'inc/options-page-wrapper.php' );

    }

    //Add new Custom Post Type named food_drink_menu_items:
    function register_wp_food_drink_custom_content(){

        $labels = array(
            'name' => __( 'Food & Drink Menu Items' ),
            'singular_name' => _x( 'Food & Drink Menu Item' ),
            'add_new' => _x( 'Add New', 'menu_item' ),
            'add_new_item' => _x( 'Add New Menu Item' ),
            'edit_item' => _x( 'Edit Menu Item' ),
            'new_item' => _x( 'New Menu Item' ),
            'view_item' => _x( 'View Menu Item' ),
            'search_items' => _x( 'Search Menu Items' ),
            'not_found' => _x( 'No Menu Items found' ),
            'not_found_in_trash' => _x( 'No Menu Items found in Trash' ),
            'parent_item_colon' => _x( 'Parent Menu Item:' ),
            'menu_name' => _x( 'Food & Drink Menu Items' ),
        );
     
        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'Food & Drink Menu Items',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'food_drink_menu_item'),
        );

        register_post_type( 'menu_items', $args );

    }

    add_action( 'init', 'register_wp_food_drink_custom_content' );

    function add_food_drink_menu_meta_boxes(){

        //add meta box for Video type and description:
        add_meta_box('meta_box_html_id', 'Size Prices', 
        'menu_item_details', 'menu_items', 'normal', 'high');

    }

    //Add custom admin Meta Boxes:
    add_action('add_meta_boxes', 'add_food_drink_menu_meta_boxes');

    function menu_item_details(){

        // Update the options for getting the item sizes from the database
        $options = get_option( 'size_type' );
        global $post;
        global $size_prices;

        //Noncename needed to verify where the data originated
        // echo '<input type="hidden" name="size_prices" id="size_prices" value="' .
        // wp_create_nonce(plugin_basename(__FILE__)) . '" />';
        wp_nonce_field( basename( __FILE__ ), 'size_prices_nonce' );

        //Start size price number field HTML:
        $count = 0;

        if( $options['wp-food-drink_sizes'] ){
            
            // Loop through the drink sizes specified in the settings page
            // And populate the metabox with a price option for each size
            foreach( $options['wp-food-drink_sizes'] as $size ) {

                $size_prices[$count] = get_post_meta( $post->ID, '_size_price_' . $count, true );
                echo get_post_meta( $post->ID, 'size_price_' . $count, true );
                ?>
                    <p>
                        <label for="size_price_<?php echo $count; ?>"><?php echo $size . ': '; ?>$</label>
                        <input type="number" id="size_price_<?php echo $count; ?>" 
                        name="size_price_<?php echo $count; ?>" step="0.01" value="<?php echo $size_prices[$count]; ?>" />
                    </p>
                <?php

                $count+=1;

            }

        }

    }

    /*
    *
    * Code snippets taken and modified from https://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress/
    *
    */

    function save_menu_item_data( $post_id, $post ){

        // Update the options for getting the item sizes from the database
        // This way we are able to iterate through the number of sizes we have
        // And populate the metaboxes
        $options = get_option( 'size_type' );

        // Verify the nonce before proceeding. 
        if ( !isset( $_POST['size_prices_nonce'] ) || !wp_verify_nonce( $_POST['size_prices_nonce'], basename( __FILE__ ) ) )
            return $post_id;

        // Get the post type object.
        $post_type = get_post_type_object( $post->post_type );

        // Check if the current user has permission to edit the post.
        if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
            return $post_id;

        // Save the metadata from each Size Price
        for( $i = 0; $i < sizeof( $options['wp-food-drink_sizes'] ); $i+=1 ){

            // Get the posted data and sanitize it for use as an HTML class.
            $new_meta_value = isset( $_POST['size_price_' . $i] ) ? esc_html( $_POST['size_price_' . $i] ) : '';

            // Get the meta key.
            $meta_key = '_size_price_' . $i;

            // Get the meta value of the custom field key.
            $meta_value = get_post_meta( $post_id, $meta_key, true );

            // If a new meta value was added and there was no previous value, add it.
            if ( $new_meta_value && '' == $meta_value )
                add_post_meta( $post_id, $meta_key, $new_meta_value, true );

            // If the new meta value does not match the old value, update it.
            elseif ( $new_meta_value && $new_meta_value != $meta_value )
                update_post_meta( $post_id, $meta_key, $new_meta_value );

            // If there is no new meta value but an old value exists, delete it. 
            elseif ( '' == $new_meta_value && $meta_value )
                delete_post_meta( $post_id, $meta_key, $meta_value );
        /**
            // Verify the metadata is set
            if( isset($_POST['size_price_' . $i]) )
                update_post_meta( $post_id, '_size_price_' . $i, strip_tags( $_POST['size_price_' . $i] ) );
            else
                break;
        **/
        }

    }

    // Save post meta on the 'save_post' hook.
    add_action( 'save_post', 'save_menu_item_data', 10, 2 );


    /*
    *
    * Food & Drink Menu Widget
    *
    */

    class Food_Drink_Menu extends WP_Widget {

        // constructor
        function food_drink_menu(){

            // Instantiate the parent object
            parent::__construct( false, 'Food & Drink Menu Widget' );

        }

        // widget form creation
        function form( $instance ){  



        }

        // widget update
        function update( $new_instance, $old_instance ){

            $instance = $old_instance;
            $instance['title'] = strip_tags( $new_instance['title'] );

            return $instance;

        }

        // widget display
        function widget( $args, $instance ){

            // Widget output

            //Set the title from the widget settings:
            $title = apply_filters( 'widget_title', $instance['title'] );

            require( 'inc/front-end-menu.php' );
            echo plugin_dir_url( __FILE__ ) . 'css/food-drink-menu-styles.css';    

        }

    }

    // Register widget
    add_action('widgets_init', create_function('', 'return register_widget("Food_Drink_Menu");'));

    function wp_food_drink_menu_front_end_scripts_styles() {

        wp_enqueue_style( 'wp_food_drink_menu_front_end_scripts_styles', plugin_dir_url( __FILE__ ) . 'css/food-drink-menu-styles.css' );

    } 

    add_action( 'wp_enqueue_scripts', 'wp_food_drink_menu_front_end_scripts_styles', 50 );


?>
































