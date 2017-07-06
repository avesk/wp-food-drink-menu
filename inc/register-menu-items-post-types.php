    function wpfood_drink_custom_post_type(){

            $labels = array(
                'name' => 'Menu-Items',
                'singular_name' => 'Food & Drink Menu Item',
                'add_new' => 'Add New Menu Item',
                'add_new_item' => 'Add New Menu Item',
                'edit_item' => 'Edit Menu Item',
                'new_item' => 'New Menu Item',
                'all_items' => 'All Menu Items',
                'view_item' => 'View Menu Item',
                'search_items' => 'Search Menu Items',
                'not_found' =>  'No Items Found',
                'not_found_in_trash' => 'No Items found in Trash', 
                'parent_item_colon' => '',
                'menu_name' => 'Menu Items',
            );

            //register post type
            register_post_type( 'product', 
                array(
                    'labels' => $labels,
                    'has_archive' => true,
                    'public' => true,
                    'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
                    'taxonomies' => array( 'post_tag', 'category' ),    
                    'exclude_from_search' => false,
                    'capability_type' => 'post',
                    'rewrite' => array( 'slug' => 'products' ),
                )
            );

        }

        add_action('init', 'wpfood_drink_custom_post_type');