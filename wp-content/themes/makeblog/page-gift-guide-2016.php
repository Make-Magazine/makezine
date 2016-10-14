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
        <li><button class="btn btn-link">Technology</button></li>
        <li><button class="btn btn-link">Digital Fabrication</button></li>
        <li><button class="btn btn-link">Craft &amp; Design</button></li>
        <li><button class="btn btn-link">Drones &amp; Vehicles</button></li>
        <li><button class="btn btn-link">Science</button></li>
        <li><button class="btn btn-link">Home</button></li>
        <li><button class="btn btn-link">Workshop</button></li>
      </ul>

      <div class="dropdown">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2016-price-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          PRICE
          <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="gg2016-price-menu">
          <li><a href="#">Low to High</a></li>
          <li><a href="#">High to Low</a></li>
        </ul>
      </div>

    </div>
  </nav>

  <div class="gg2016-body container" itemscope itemtype="http://schema.org/ItemList">

  <?php if( have_rows('products') ): ?>

    <?php while( have_rows('products') ): the_row(); 

      $product_name = get_sub_field('product_name');
      $product_description = get_sub_field('product_description');
      $author_name = get_sub_field('author_name');
      $price = get_sub_field('price');
      $url = get_sub_field('url');
      $image = get_sub_field('image');

      ?>

      <article class="gg2016-review" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
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
            <p class="gg2016-review-price"><?php echo $price; ?></p>
          <?php endif; ?>
          <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank" itemprop="url">Buy</a>
        </div>
      </article>

    <?php endwhile; ?>

  <?php endif; ?>

<!--     <article class="gg2016-review" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
      <div class="gg2016-review-img">
        <a href="#" target="_blank" itemprop="url">
          <img src="http://makezine.com/wp-content/uploads/2016/10/MakeKits-RaspPi-components_web_large.jpg" alt="Maker Gift Guide Image" class="img-responsive" itemprop="image" />
        </a>
      </div>
      <div class="gg2016-review-info">
        <a href="#" target="_blank" itemprop="url">
          <h4 itemprop="name">Make: Getting Started with Raspberry Pi 3.0</h4>
        </a>
        <div class="gg2016-review-desc" itemprop="description">We made this special kit to contain the just the components you need to get started, including our book "Getting Started with Raspberry Pi - 3rd Edition".</div>
        <p class="gg2016-review-person">By John Doe</p>
        <p class="gg2016-review-price">$16.99</p>
        <a href="#" class="btn-red padleft padright" target="_blank" itemprop="url">Buy</a>
      </div>
    </article>

    <article class="gg2016-review">
      <div class="gg2016-review-img">
        <a href="#" target="_blank">
          <img src="http://makezine.com/wp-content/uploads/2016/10/EC2_1_large.jpg" alt="2016 Maker Gift Guide Pick" class="img-responsive" />
        </a>
      </div>
      <div class="gg2016-review-info">
        <a href="#" target="_blank">
          <h4>Make: Electronics Components Pack 2</h4>
        </a>
        <div class="gg2016-review-desc">The Make: Electronics Components Pack 2, updated in 2015, contains 200+ components to help you to recreate the experiments from the 2nd Edition of Make: Electronics by Charles Platt. This new edition of Charles Platt's seminal beginner's guide to electronics continues the "learning through discovery" model for which it has been praised since the text was first published in 2009.</div>
        <p class="gg2016-review-person">By John Doe</p>
        <p class="gg2016-review-price">$109</p>
        <a href="#" class="btn-red padleft padright" target="_blank">Buy</a>
      </div>
    </article> -->

  </div><!-- .gg2016-body -->

</div><!-- #gg2016 -->

<?php get_footer(); ?>