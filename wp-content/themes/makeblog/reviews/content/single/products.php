<?php
$image = get_field('hero_image');

if (!empty($image)) {
    $has_hero = '';
} else {
    $has_hero = 'no-hero';
}
?>

<div id="content-wrap" class="container <?php echo $has_hero; ?>">
    <div class="row cw-content">
        <div id="product-content" class="col-sm-8" itemscope itemtype="http://schema.org/Article">

            <meta itemprop="name" content="Make: Magazine">

            <h2 class="product-title" itemprop="headline"><?php the_title(); ?>!!!</h2>
			   <?php // Social Share
				  $url = str_replace(home_url(), 'https://makezine.com', get_permalink());
				  $title = get_the_title();
				  echo do_shortcode('[easy-social-share buttons="facebook,twitter,reddit,pinterest,love,more" morebutton="2" morebutton_icon="dots" counters=1 counter_pos="bottom" total_counter_pos="hidden" style="button" nospace="yes" fullwidth="yes" template="metro-retina" url="' . $url . '" text="' . $title . '"]');
				?>	
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div itemprop="description">
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php get_template_part('reviews/content/single/products/specs'); ?>

        </div><!-- .col -->

        <div id="product-sidebar" class="col-sm-4">
            <?php get_template_part('reviews/content/sidebar/products'); ?>
        </div><!-- .col -->
        
        <div class="ad-2">
            <?php global $make;
            print $make->ads->ad_leaderboard_alt_btf; ?>
        </div>
    </div><!-- .cw-content -->
</div><!-- .container -->