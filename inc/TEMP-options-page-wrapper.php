<div class="wrap">

	<h1>Official Food & Drink Menu Plugin</h1>

	<div id="post-stuff">

		<!-- main content -->
		<div id="post-body-content">

			<h2>Add Up to 4 Sizes</h2>

			<div class="inside">
				<form name="sizes" method="post" action="">

					<input type="hidden" name="wp-food-drink_sizes_form_submitted" value="Y">

		<!-- Load preset blank size inputs if the user has not entered in any data -->
					<?php if( !isset($sizes) ): ?>
						<?php require( 'options-inc/unset-sizes.php' ) ?>
					<?php else: ?>
						<?php require( 'options-inc/isset-sizes.php' ) ?>
					<?php endif; ?>
					
					<p><input class="button-primary" type="submit" name="submit" value="Save" /></p>

				</form>
				<!-- END Size form -->

				<h2>Add Menu Items</h2>
				<p>How many Items?</p>
				<form name="How many Items?" method="post" action="">

					<input type="hidden" name="wp-food-drink_num_items" value="Y">

				<?php if( is_null($num_items) ): ?>
					<input type="number" name="wp-food-drink_num" min="0">
				<?php else: ?>
					<input type="number" name="wp-food-drink_num" min="0" value="<?php echo $num_items; ?>">
				<?php endif; ?>
			<!-- ERROR HANDLE: Don't allow the user to enter the number 
			of items until they have set their sizes -->
				<?php

					$isset = False;

					if( isset($sizes) ){

						for( $i = 0; $i < sizeOf($sizes); $i+=1 ){

							if( $sizes[$i] != '' ){
								$isset = True;
								break;

							}

						}

					}

					if( $isset ):

				?>
					<p><input class="button-primary" type="submit" name="submit" value="Save" /></p>
				<?php else: ?>
					<p><b>ALERT:</b> Please set at least one size before setting the number of items</p>
				<? endif; ?>
				</form>	

			<?php if( isset($_POST['wp-food-drink_num_items']) ): ?>

				<input type="hidden" name="wp-food-drink_add_items_form_submitted" value="Y">
				<?php for( $j = 0; $j < $num_items; $j+=1 ): ?>
						<table class="form-table">
								<tr>
								<td>
									<label>Item <?php echo ($j+1) ?></label>
								</td>
								<td>
									<input name='wp-food-drink_item_name' id='wp-food-drink_item_name_<?php echo $j ?>' type="text" class="regular-text" />
								</td>
							</tr>
							<!-- END Item name -->
						</table>
				<?php endfor; ?>
						<p>
						<input class="button-primary" type="submit" name="submit" value="Save" />
						</p>

				</form>
				<!-- END Add Item form -->	
			<?php endif; ?>	

			</div>
			<!-- .inside -->

		</div>
		<!-- END main content -->

	</div>
	<!-- END post-stuff -->

</div>
<!-- END .wrap -->