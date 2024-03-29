<?php
/**
 * The template for displaying attachments. Notably, photos and other media types.
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * @author     Jake Spurlock <jspurlock@makermedia.com>
 * Template Name: Archives Page
 *
 */

get_header('universal'); ?>

  <div class="single container">

    <div class="row">

      <div class="col-sm-7 col-md-8">

        <p>
          <a href="<?php echo get_permalink( $post->post_parent ); ?>">
            <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i> <?php echo get_the_title( $post->post_parent ); ?>
          </a>
        </p>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

          <article <?php post_class(); ?>>

            <h1><?php the_title(); ?></h1>

            <?php if ( wp_attachment_is_image() ) : ?>

	            <p class="meta top">By <?php the_author_posts_link(); ?>, <?php the_time('m/d/Y \@ g:i a') ?>=
	            	<?php echo ' <span class="meta-sep">|</span> ';
	                $metadata = wp_get_attachment_metadata();
	                printf( __( 'Full size is %s pixels', 'makezine'),
	                  sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
	                    wp_get_attachment_url(),
	                    esc_attr( __('Link to full-size image', 'makezine') ),
	                    $metadata['width'],
	                    $metadata['height']
	                  )
	                ); ?>
	            </p>

	            <div class="entry-attach">
	              <div class="entry-attachment">
	                <?php
	                  $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	                  foreach ( $attachments as $k => $attachment ) {
	                    if ( $attachment->ID == $post->ID )
	                      break;
	                  }
	                  $k++;
	                  // If there is more than 1 image attachment in a gallery
	                  if ( count( $attachments ) > 1 ) {
	                    if ( isset( $attachments[ $k ] ) )
	                      // get the URL of the next image attachment
	                      $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
	                    else
	                      // or get the URL of the first image attachment
	                      $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	                  } else {
	                    // or, if there's only 1 image attachment, get the URL of the image
	                    $next_attachment_url = wp_get_attachment_url();
	                  }
	                ?>
	                <p class="attachment">
	                  <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
	                    <?php
	                      $attachment_size = apply_filters( 'makezine_attachment_size', 598 );
	                      echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height.
	                    ?>
	                  </a>
	                </p>
	              </div>

	              <ul class="list-unstyled">
	                <?php $imgmeta = wp_get_attachment_metadata( $id );

	                // Convert the shutter speed retrieve from database to fraction
	                if(isset($imgmeta['image_meta']['shutter_speed']) && $imgmeta['image_meta']['shutter_speed']> 0 &&
	                  (1 / $imgmeta['image_meta']['shutter_speed']) > 1) {
	                  if ((number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1)) == 1.3
	                    or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.5
	                    or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 1.6
	                    or number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1) == 2.5){
	                      $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 1, '.', '') . " second";
	                  } else {
	                    $pshutter = "1/" . number_format((1 / $imgmeta['image_meta']['shutter_speed']), 0, '.', '') . " second";
	                  }
	                } else {
	                  $pshutter = $imgmeta['image_meta']['shutter_speed'] . " seconds";
	                }

	                // Start to display EXIF and IPTC data of digital photograph
	                if (($imgmeta['image_meta']['created_timestamp']) != null ) {
	                  echo "<li><strong>Date Taken:</strong> " . date("d-M-Y H:i:s", esc_html($imgmeta['image_meta']['created_timestamp']))."</li>";
	                }
	                if (($imgmeta['image_meta']['copyright']) != null) {
	                  echo "<li><strong>Copyright:</strong> " . esc_html($imgmeta['image_meta']['copyright'])."</li>";
	                }
	                if (($imgmeta['image_meta']['credit']) != null) {
	                  echo "<li><strong>Credit:</strong> " . esc_html($imgmeta['image_meta']['credit'])."</li>";
	                }
	                if (($imgmeta['image_meta']['title']) != null) {
	                  echo "<li><strong>Title:</strong> " . esc_html($imgmeta['image_meta']['title'])."</li>";
	                }
	                if (($imgmeta['image_meta']['caption']) != null) {
	                  echo "<li><strong>Caption:</strong> " . esc_html($imgmeta['image_meta']['caption'])."</li>";
	                }
	                if (($imgmeta['image_meta']['camera']) != null) {
	                  echo "<li><strong>Camera:</strong> " . esc_html($imgmeta['image_meta']['camera'])."</li>";
	                }
	                if (($imgmeta['image_meta']['focal_length']) != null) {
	                  echo "<li><strong>Focal Length:</strong> " . esc_html($imgmeta['image_meta']['focal_length'])."mm</li>";
	                }
	                if (($imgmeta['image_meta']['aperture']) != null) {
	                  echo "<li><strong>Aperture:</strong> f/" . esc_html($imgmeta['image_meta']['aperture'])."</li>";
	                }
	                if (($imgmeta['image_meta']['iso']) != null) {
	                  echo "<li><strong>ISO:</strong> " . esc_html($imgmeta['image_meta']['iso'])."</li>";
	                }
	                if (($imgmeta['image_meta']['pshutter']) != null) {
	                  echo "<li><strong>Shutter Speed:</strong> " . esc_html($pshutter) . "</li>";
	                }

	                 ?>
	              </ul>

	            </div>

	            <hr>

	            <?php echo make_author(); ?>

            <?php else : ?>

              <a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>

            <?php endif; ?>

          </article>

        <?php endwhile; ?>

          <!--<div id="contextly"></div>-->

        <?php  else: ?>

          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

        <?php endif; ?>

      </div><!-- col-sm-7 col-md-8 -->

      <?php get_sidebar(); ?>

    </div><!-- row -->  

  </div><!-- single container -->

<?php get_footer(); ?>