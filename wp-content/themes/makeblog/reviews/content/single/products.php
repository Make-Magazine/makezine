<?php
$image = get_field('hero_image');

if ( ! empty( $image ) ){
	$has_hero = '';
}else{
	$has_hero = 'no-hero';
}
?>

<div id="content-wrap" class="container <?php echo $has_hero;?>">
	<div class="row cw-content">
		<div id="product-content" class="col-sm-8" itemscope itemtype="http://schema.org/Article">

			<meta itemprop="name" content="Make: Magazine">

			<h2 class="product-title" itemprop="headline"><?php the_title(); ?></h2>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div itemprop="description">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
			<?php endif; ?>

			<?php get_template_part( 'reviews/content/single/products/specs' ); ?>

		</div><!-- .col -->

		<div id="product-sidebar" class="col-sm-4">
			<?php get_template_part( 'reviews/content/sidebar/products' ); ?>
		</div><!-- .col -->
		
      <!-- comment out disqus code -->
		<!--<div class="col-sm-12 pull-left">

			<?php //echo do_shortcode( '[contextly_main_module]' ); ?>

			<div id="disqus_thread"></div>
			<script>
				//https://help.disqus.com/customer/portal/articles/472097-universal-embed-code
			    (function() {  // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
			        var d = document, s = d.createElement('script');

			        s.src = '//makezine.disqus.com/embed.js';  // IMPORTANT: Replace EXAMPLE with your forum shortname!

			        s.setAttribute('data-timestamp', +new Date());
			        (d.head || d.body).appendChild(s);
			    })();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

		</div>--> <!-- .col -->
		<div class="ad-2">
      <?php global $make; print $make->ads->ad_leaderboard_alt_btf; ?>
    </div>
	</div><!-- .cw-content -->
</div><!-- .container -->