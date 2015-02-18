<?php
/**
 * Template Name: Maker Camp Map
 * Nothing fancy but a template holder... Add all content via the post editor.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Cole Geissinger <cgeissinger@makermedia.com>
 * 
 */
?>

<?php get_header( 'makercamp' ); ?>
	<?php 
		$get_addresses = get_post_meta( get_the_ID(), 'makercamp-maps-data', false );
		$addresses = json_decode( str_replace( '&quot;', '"', $get_addresses[0] ), true );
	?>
	<script>
		jQuery(document).ready(function( $ ) {
			$( '.map-list' ).tablesorter();
		});
	</script>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="main-content">
			<div class="container map-wrapper">
				<div class="row">
					<?php the_content(); ?>
				</div>
				<div class="row">
					<div class="span12">
						<table class="table table-striped map-list">
							<thead class="map-list-header">
								<tr>
									<th style="width:55px;">Country</th>
									<th style="width:75px;">State</th>
									<th style="width:140px;">City</th>
									<th style="width:228px;">Organization</th>
									<th style="width:81px;">Website</th>
									<th style="width:25px;">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									if ( ! empty( $addresses ) && is_array( $addresses ) ) :
										foreach ( $addresses as $address ) : ?>
											<tr>
												<td><?php echo esc_attr( $address['Work Country'] ); ?></td>
												<td><?php echo esc_attr( $address['Work State'] ); ?></td>
												<td><?php echo esc_attr( $address['Work City'] ); ?></td>
												<td><?php echo esc_attr( $address['Company'] ); ?></td>
												<td><a href="<?php echo esc_url( $address['Website'] ); ?>"><?php echo esc_url( $address['Website'] ); ?></a></td>
												<td>
													<?php if ( isset( $addressss['Google Link'] ) ) : ?>
														<a href="<?php echo esc_url( $address['google-plus'] ); ?>"><img src="http://makezineblog.files.wordpress.com/2013/06/google-plus.png"></a>
													<?php endif; ?>
												</td>
											</tr>
										<?php endforeach;
									endif;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; endif; ?>
<?php get_footer( 'makercamp' ); ?>