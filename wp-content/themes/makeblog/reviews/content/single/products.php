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

            <h2 class="product-title" itemprop="headline"><?php the_title(); ?></h2>

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