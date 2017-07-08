<!--Width issue fix-->
<style>
    
    div.default-page-the_content_wrapper {
        width: 100%;
    }

</style>


<h3>ALL PRICES INCLUDE TAX</h3>

    <table id="wp-food-drink-menu-html-table">
<?php 
    
    // Get Sizes
    $options = get_option( 'size_type' );
    
    // If there are sizes, populate the columns of the table with sizes
    if( $options['wp-food-drink_sizes'] != '' ){
        
        // echo out the row
        echo '<tr id="sizes">';
        
        //echo a blank column for drink names
        echo '<td></td>';
        
        foreach( $options['wp-food-drink_sizes'] as $size ){
            
            echo '<td>' . $size . '</td>';
            
        }
        
        // End the row
        echo '</tr>';
        
    }


?>

<?php 

    $menu_items = new WP_Query( array('post_type' => 'menu_items') );
    
    if( $menu_items->have_posts() ) : while( $menu_items->have_posts() ): $menu_items->the_post();
        
?>

    <tr>
        
        <td class="drink"><?php the_title(); ?></td>
        
        <!-- echo the price for each size:-->
        <?php 
            for( $i = 0; $i < sizeof($options['wp-food-drink_sizes']); $i++ ){
                
                if( get_post_meta(get_the_ID(), '_size_price_' . $i, true) ){
                    
                    echo '<td>' . get_post_meta(get_the_ID(), '_size_price_' . $i, true) . '</td>';
                
                }
                    
            } 
        
        ?>
        
    </tr>
    
    <?php endwhile; endif; ?>
 
  </table>