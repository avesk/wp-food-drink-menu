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
<!--
    <tr>
      <td class="drink">Cappucino/Latte</td>
      <td>4.00</td>
      <td>4.50</td>
      <td>5.00</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Breve</td>
      <td>4.50</td>
      <td>5.25</td>
      <td>6.00</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Sweet Mocha Bean Breve <i>"The Brahi"</i></td>
      <td>5.00</td>
      <td>5.75</td>
      <td>6.50</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Americano</td>
      <td>-</td>
      <td>3.25</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Mocha Bean Americano</td>
      <td>-</td>
      <td>2.75</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Espresso</td>
      <td>2.75</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <th class="drink-head">For The Kids:</th>
    <tr class="drink">
      <td class="drink">Hot Chocoloate</td>
      <td>3.25</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Steamed Milk</td>
      <td>3.00</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Matcha</td>
      <td>4.00</td>
      <td>4.75</td>
      <td>5.50</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Chai Latte</td>
      <td>-</td>
      <td>4.25</td>
      <td>5.00</td>
      <td>-</td>
    </tr>

     <tr>
      <td class="drink">Nelson Fog</td>
      <td>-</td>
      <td>5.00</td>
      <td>6.00</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Hot Chocolate</td>
      <td>-</td>
      <td>4.25</td>
      <td>4.75</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Mayan Hot Chocolate</td>
      <td>-</td>
      <td>4.50</td>
      <td>5.00</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Mate Latte</td>
      <td>-</td>
      <td>4.00</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Mate Latte</td>
      <td>-</td>
      <td>4.00</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <tr>
      <td class="drink">Herbal or Black Tea</td>
      <td>-</td>
      <td>3.00</td>
      <td>-</td>
      <td>-</td>
    </tr>

    <th class="drink-head">Iced Frappe:</th>
    <tr>
      <td class="drink">Espresso</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>6.00</td>
    </tr>
    <tr>
      <td class="drink">Mocha</td>
      <td>-</td>
      <td>-</td>
      <td>-</td>
      <td>6.00</td>
    </tr>
-->

  </table>