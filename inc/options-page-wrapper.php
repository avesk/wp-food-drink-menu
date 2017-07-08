<style type="text/css">

	#wpfooter{

		position: relative;
		top: 50px;

	}

</style>
<div class="wrap" style="padding-bottom: 50px;">

	<h1>Official Food & Drink Menu Plugin</h1>

	<div id="post-stuff">

		<!-- main content -->
		<div id="post-body-content">

			<h2>How Many Different Sizes Do You Have?</h2>
				<form name="num_sizes" method="post" action="">

					<input type="hidden" name="wp-food-drink_num_sizes_form_submitted" value="Y">

				<?php if( is_null($num_sizes) ): ?>
					<input type="number" name="wp-food-drink_num_sizes" id="wp-food-drink_num_sizes" min="0">
					<p><input class="button-primary" type="submit" name="submit" value="Next" /></p>
				<?php else: ?>
					<input type="number" name="wp-food-drink_num_sizes" id="wp-food-drink_num_sizes" min="1" value="<?php echo $num_sizes; ?>">
					<p><input class="button-primary" type="submit" name="submit" value="Update" /></p>
				<?php endif; ?>

				</form>	

			<?php if( isset($_POST['wp-food-drink_num_sizes']) || $num_sizes != null || $num_sizes != '' || $num_sizes = 0 ): ?>
			<div id="size-type" >
				<h2>What Type Of Sizes?</h2>
				<p>Eg.) 12 oz</p>
				<form name="size_type" method="post" action="">
				<input type="hidden" name="wp-food-drink_add_size_type_form_submitted" value="Y">
				<?php for( $j = 0; $j < $num_sizes; $j+=1 ): ?>
						<table class="form-table">
								<tr>
								<td>
									<label>Size <?php echo ($j+1) ?></label>
								</td>
								<td>
									<input name='wp-food-drink_size_name_<?php echo $j ?>' id='wp-food-drink_size_name_<?php echo $j ?>' type="text" class="regular-text" 
									value="<?php echo $sizes[$j] != null ? $sizes[$j] : '' ?>" />
								</td>
							</tr>
						</table>
				<?php endfor; ?>
						<p>
						<input class="button-primary" type="submit" name="submit" value="Save" />
						</p>

				</form>
				<!-- END Size Select form -->
			</div>	
			<?php endif; ?>	

		<br />

		<h3>Adding Menu Items:</h3>
			<p>In Order to add menu items navigate to the Food & Drink Menu Items and select 'Add New' in the drop down</p>

		<h3>Shortcode Support:</h3>
			<p>Display this menu on any page or post via the shortcode: [wp-food-drink-menu]</p>
			<p>I.E. copy and paste '[wp-food-drink-menu]' into the body content</p>	
		
		</div>
		<!-- .inside -->

		</div>
		<!-- END main content -->

	</div>
	<!-- END post-stuff -->

</div>
<!-- END .wrap -->