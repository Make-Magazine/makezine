<?php
/**
 * Template Name: Gift Guide 2016
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 * 
 */
get_header('version-2'); ?>

<div id="gg2016">

  <header class="gg2016-header container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <h1>2016 Maker Gift Guide</h1>
        <h2>Created by makers, for makers</h2>
        <h3>Share your best tool, gadget, and project recommendations.</p>
      </div>
      <div class="col-xs-12 col-sm-6">
        <img src="http://makezine.com/wp-content/uploads/2016/10/Screen-Shot-2016-10-06-at-5.25.37-PM.png" alt="Daily pick. Our recommended gift of the day." class="img-responsive" />
      </div>
    </div>
  </header>

  <nav class="gg2016-nav">
    <div class="container">
      <ul class="gg2016-nav-flex list-unstyled">
        <li>
          <button class="btn btn-link filter" data-filter="all"><span>All</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-tec"><span>Technology</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-dig"><span>Digital Fabrication</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-cra"><span>Craft &amp; Design</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-dro"><span>Drones &amp; Vehicles</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-sci"><span>Science</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-hom"><span>Home</span></button>
        </li>
        <li>
          <button class="btn btn-link filter" data-filter=".category-wor"><span>Workshop</span></button>
        </li>
      </ul>

      <div class="dropdown">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2016-price-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          PRICE
          <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="gg2016-price-menu">
          <li><a href="#" class="sort" data-sort="myorder:asc">Low to High</a></li>
          <li><a href="#" class="sort" data-sort="myorder:desc">High to Low</a></li>
        </ul>
      </div>

    </div>
  </nav>

  <div id="gg2016-js" class="gg2016-body container" itemscope itemtype="http://schema.org/ItemList">

  <?php if( have_rows('products') ): ?>

    <?php while( have_rows('products') ): the_row(); 

      $product_name = get_sub_field('product_name');
      $product_description = get_sub_field('product_description');
      $author_name = get_sub_field('author_name');
      $price = get_sub_field('price');
      $url = get_sub_field('url');
      $image = get_sub_field('image');
      $category = get_sub_field('category');

      $priceNoComma = str_replace( ',', '', $price );

      ?>

      <article class="gg2016-review mix <?php if( $category ): echo implode(' ', $category); ?> <?php endif; ?> <?php if(get_sub_field('sponsored')){ echo 'gg2016-sponsored'; } ?>" data-myorder="<?php echo round($priceNoComma); ?>" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
        <?php if(get_sub_field('sponsored')){ echo '<h5>SPONSORED</h5>'; } ?>
        <div class="gg2016-review-flex-cont">
          <div class="gg2016-review-img">
            <a href="<?php echo $url; ?>" target="_blank" itemprop="url">
              <img src="<?php echo $image; ?>" alt="Maker Gift Guide Image" class="img-responsive" itemprop="image" />
            </a>
          </div>
          <div class="gg2016-review-info">
            <a href="<?php echo $url; ?>" target="_blank" itemprop="url">
              <h4 itemprop="name"><?php echo $product_name; ?></h4>
            </a>
            <div class="gg2016-review-desc" itemprop="description"><?php echo $product_description; ?></div>
            <?php if( $author_name ): ?>
              <p class="gg2016-review-person">By <?php echo $author_name; ?></p>
            <?php endif; ?>
            <?php if( $price ): ?>
              <p class="gg2016-review-price">$<?php echo $price; ?></p>
            <?php endif; ?>
            <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank" itemprop="url">Buy</a>
          </div>
        </div>
      </article>

    <?php endwhile; ?>

  <?php endif; ?>

  </div><!-- .gg2016-body -->

</div><!-- #gg2016 -->

<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script>
  jQuery( document ).ready(function() {

    jQuery('#gg2016-js').mixItUp({
      load: {
        sort: 'random'
      }
    });

  });

</script>


<?php get_footer(); ?>


