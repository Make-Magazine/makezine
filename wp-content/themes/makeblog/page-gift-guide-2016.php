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
  <?php global $make; print $make->ads->ad_leaderboard_alt; ?>

  <header class="gg2016-header container">
    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-6 gg2016-header-info">
        <?php 
        $header_title = get_field('header_title');
        $header_subtitle = get_field('header_subtitle');
        $header_description = get_field('header_description');
        ?>
        <h1><?php echo $header_title; ?></h1>
        <h2><?php if( $header_subtitle ): ?><?php echo $header_subtitle; ?><?php endif; ?></h2>
        <h3><?php echo $header_description; ?></p>
      </div>

      <?php if( have_rows('products') ):

        while( have_rows('products') ): the_row(); 

          $product_name = get_sub_field('product_name');
          $product_description = get_sub_field('product_description');
          $author_name = get_sub_field('author_name');
          $price = get_sub_field('price');
          $url = get_sub_field('url');
          $image = get_sub_field('image');
          $daily_pick = get_sub_field('daily_pick');
        
          if(get_sub_field('daily_pick')) { ?>

            <div class="col-xs-12 col-sm-5 col-md-6">
              <div class="gg2016-dp" style="background: url(<?php echo $image; ?>);">
                <span class="btn-red padleft padright">DAILY PICK</span>
                <div class="gg2016-dp-text">
                  <a href="<?php echo $url; ?>" target="_blank">
                    <h4><?php echo $product_name; ?></h4>
                    <p class="gg2016-dp-desc"><?php echo $product_description; ?></p>
                  </a>
                  <?php if( $author_name ): ?>
                    <p class="gg2016-dp-author">By <?php echo $author_name; ?></p>
                  <?php endif; ?>
                  <?php if( $price ): ?>
                    <p class="gg2016-dp-price"><?php echo $price; ?></p>
                  <?php endif; ?>
                  <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank">Buy</a>
                </div>
              </div>
            </div>

          <?php 
          }

        endwhile;

      endif; ?>

    </div>
  </header>

  <nav class="gg2016-nav">
    <div class="container">

      <div class="dropdown gg2016-dd1">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2016-cat-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          TYPE <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="gg2016-nav-flex dropdown-menu list-unstyled" aria-labelledby="gg2016-cat-menu">
          <li>
            <button onclick="removeHashFunction()" class="btn btn-link filter" data-filter="all"><span>All</span></button>
          </li>
          <li>
            <a href="#technology" class="btn btn-link filter" data-filter=".category-tec"><span>Technology</span></a>
          </li>
          <li>
            <a href="#digital-fabrication" class="btn btn-link filter" data-filter=".category-dig"><span>Digital Fabrication</span></a>
          </li>
          <li>
            <a href="#craft-design" class="btn btn-link filter" data-filter=".category-cra"><span>Craft &amp; Design</span></a>
          </li>
          <li>
            <a href="#drones-vehicles" class="btn btn-link filter" data-filter=".category-dro"><span>Drones &amp; Vehicles</span></a>
          </li>
          <li>
            <a href="#science" class="btn btn-link filter" data-filter=".category-sci"><span>Science</span></a>
          </li>
          <li>
            <a href="#home" class="btn btn-link filter" data-filter=".category-hom"><span>Home</span></a>
          </li>
          <li>
            <a href="#workshop" class="btn btn-link filter" data-filter=".category-wor"><span>Workshop</span></a>
          </li>
        </ul>
      </div>

      <div class="dropdown gg2016-dd2">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2016-price-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          PRICE <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="gg2016-price-menu">
          <li>
            <button class="sort" data-sort="myorder:asc">Low to High</button>
          </li>
          <li>
            <button class="sort" data-sort="myorder:desc">High to Low</button>
          </li>
        </ul>
      </div>

    </div>
  </nav>

  
  <div class="gg2016-body-bg">

    <div id="gg2016-js" class="gg2016-body container" itemscope itemtype="http://schema.org/ItemList">

    <?php if( have_rows('products') ): ?>

      <?php while( have_rows('products') ): the_row(); 

        $product_name = get_sub_field('product_name');
        $product_description = get_sub_field('product_description');
        $author_name = get_sub_field('author_name');
        $price = get_sub_field('price');
        $price2 = get_sub_field('price_used_for_sorting_not_shown');
        $url = get_sub_field('url');
        $image = get_sub_field('image');
        $category = get_sub_field('category');
        $priceNoComma = str_replace( ',', '', $price2 );

        if(!get_sub_field('sponsored')) { ?>

          <article class="gg2016-review gg2016-review-even1 mix <?php if( $category ): echo implode(' ', $category); ?> <?php endif; ?>" data-myorder="<?php echo round($priceNoComma); ?>" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
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
                  <p class="gg2016-review-price"><?php echo $price; ?></p>
                <?php endif; ?>
                <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank" itemprop="url">Buy</a>
              </div>
            </div>
          </article>

        <?php }

      endwhile; ?>

    <?php endif; ?>

      <aside id="gg2016-sponsor-sm">
        <span>Brought to you by</span>
        <div></div>
      </aside>

    </div><!-- #gg2016-js.gg2016-body -->

  </div><!-- .gg2016-body-bg -->



  <div id="gg2016-sponsors" class="container">

  <?php if( have_rows('products') ): ?>

    <?php while( have_rows('products') ): the_row(); 

      $product_name = get_sub_field('product_name');
      $product_description = get_sub_field('product_description');
      $author_name = get_sub_field('author_name');
      $price = get_sub_field('price');
      $price2 = get_sub_field('price_used_for_sorting_not_shown');
      $url = get_sub_field('url');
      $image = get_sub_field('image');
      $category = get_sub_field('category');
      $priceNoComma = str_replace( ',', '', $price2 );

      if(get_sub_field('sponsored')) { ?>

        <article class="gg2016-review gg2016-review-even1 mix <?php if( $category ): echo implode(' ', $category); ?> <?php endif; ?> gg2016-sponsored" data-myorder="<?php echo round($priceNoComma); ?>" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product" style="display:inline-block;">
          <h5>SPONSORED</h5>
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
                <p class="gg2016-review-price"><?php echo $price; ?></p>
              <?php endif; ?>
              <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank" itemprop="url">Buy</a>
            </div>
          </div>
        </article>

      <?php }

    endwhile; ?>

  <?php endif; ?>

  </div><!-- #gg2016-sponsors -->

</div><!-- #gg2016 -->


<script src="http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js"></script>
<script>
  function removeHashFunction() {
    history.pushState("", document.title, window.location.pathname);
  }

  function showHideTakeover() {

  }
  
  jQuery( document ).ready(function() {

    removeHashFunction();

    jQuery('#gg2016-sponsors').mixItUp({
      load: {
        sort: 'random'
      }
    });

    jQuery('#gg2016-js').mixItUp({
      load: {
        sort: 'random'
      },
      callbacks: {
        onMixStart: function(){
          jQuery('#gg2016-js .js-ad').remove();
          jQuery('#gg2016-js .fake-leaderboard-span').remove();

          //First reset the takeover sponsor images
          jQuery('.gg2016-body-bg').css('background', 'url(none)');
          jQuery('.gg2016-body-bg').removeClass('gg2016-active-to');
          jQuery('#gg2016-sponsor-sm div').css('background', 'url(none)');
        },

        onMixEnd: function(state){
          if (state.activeFilter != '.mix') {
            jQuery('#gg2016-js .gg2016-review').removeClass('gg2016-review-even1');
            jQuery('#gg2016-js .gg2016-review').removeClass('gg2016-review-even2');
            jQuery('#gg2016-js .gg2016-review:visible').filter(':odd').addClass('gg2016-review-even2');
          } else {
            jQuery('#gg2016-js .gg2016-review').removeClass('gg2016-review-even2');
            jQuery('#gg2016-js .gg2016-review').addClass('gg2016-review-even1');
          }

          //If a category takeover is set and active, set images
          <?php if( have_rows('choose_a_takeover_category') ):
            while( have_rows('choose_a_takeover_category') ): the_row(); 
              $category = get_sub_field('category');

              if( $category == 'category-tec' ) {
                $tecBG = get_sub_field('full_width_background_image');
                $tecSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-tec') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $tecBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $tecSM . ")');
                  }";
              } elseif ( $category == 'category-dig' ) {
                $digBG = get_sub_field('full_width_background_image');
                $digSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-dig') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $digBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $digSM . ")');
                  }";
              } elseif ( $category == 'category-cra' ) {
                $craBG = get_sub_field('full_width_background_image');
                $craSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-cra') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $craBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $craSM . ")');
                  }";
              } elseif ( $category == 'category-dro' ) {
                $droBG = get_sub_field('full_width_background_image');
                $droSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-dro') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $droBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $droSM . ")');
                  }";
              } elseif ( $category == 'category-sci' ) {
                $sciBG = get_sub_field('full_width_background_image');
                $sciSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-sci') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $sciBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $sciSM . ")');
                  }";
              } elseif ( $category == 'category-hom' ) {
                $homBG = get_sub_field('full_width_background_image');
                $homSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-hom') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $homBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $homSM . ")');
                  }";
              } elseif ( $category == 'category-wor' ) {
                $worBG = get_sub_field('full_width_background_image');
                $worSM = get_sub_field('small_square_image');
                echo "
                  if (state.activeFilter == '.category-wor') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $worBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    jQuery('#gg2016-sponsor-sm div').css('background', 'url(" . $worSM . ")');
                  }";
              }
            endwhile;
          endif; ?>
        },

        onMixLoad: function(){
          var $spon0 = jQuery('#gg2016-sponsors .gg2016-sponsored:eq(0)');
          var $spon1 = jQuery('#gg2016-sponsors .gg2016-sponsored:eq(1)');
          var $spon2 = jQuery('#gg2016-sponsors .gg2016-sponsored:eq(2)');
          var $spon3 = jQuery('#gg2016-sponsors .gg2016-sponsored:eq(3)');
          var $spon4 = jQuery('#gg2016-sponsors .gg2016-sponsored:eq(4)');
          jQuery('#gg2016-js').mixItUp('insert', 1, $spon0);
          jQuery('#gg2016-js').mixItUp('insert', 5, $spon1);
          jQuery('#gg2016-js').mixItUp('insert', 8, $spon2);
          jQuery('#gg2016-js').mixItUp('insert', 11, $spon3);
          jQuery('#gg2016-js').mixItUp('insert', 14, $spon4);

          jQuery('#gg2016-js .gg2016-review').each(function(i) {
            var modulus = (i + 1) % 4;
            if (modulus === 0) { 
              jQuery(this).after("<?php global $make; print $make->ads->ad_leaderboard; ?><span class='fake-leaderboard-span'></span>");
            }
          });
        }
      }
    });

    // if (window.location.href.indexOf('#technology') > -1) {
    //   jQuery('#gg2016-js').mixItUp('filter', '.category-tec');

    // } else if (window.location.href.indexOf('#digital-fabrication') > -1) {
    //   jQuery('.filter[href$="#digital-fabrication"]').click();

    // } else if (window.location.href.indexOf('#craft-design') > -1) {
    //   jQuery('.filter[href$="#craft-design"]').click();

    // } else if (window.location.href.indexOf('#drones-vehicles') > -1) {
    //   jQuery('.filter[href$="#drones-vehicles"]').click();

    // } else if (window.location.href.indexOf('#science') > -1) {
    //   jQuery('.filter[href$="#science"]').click();

    // } else if (window.location.href.indexOf('#home') > -1) {
    //   jQuery('.filter[href$="#home"]').click();

    // } else if (window.location.href.indexOf('#workshop') > -1) {
    //   jQuery('.filter[href$="#workshop"]').click();

    // }

    jQuery('.sort, .filter').click(function() {
      setTimeout(function() {
        jQuery('#gg2016-js .gg2016-review:visible').each(function(i) {
          var modulus = (i + 1) % 4;
          if (modulus === 0) { 
            jQuery(this).after("<?php global $make; print $make->ads->ad_leaderboard; ?><span class='fake-leaderboard-span'></span>");
          }
        });
      }, 2000);
    });

  });
</script>


<?php get_footer(); ?>


