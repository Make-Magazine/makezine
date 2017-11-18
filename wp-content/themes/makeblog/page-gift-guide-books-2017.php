<?php
/**
 * Template Name: Gift Guide Books 2017
 *
 * @package    makeblog
 * @license    http://opensource.org/licenses/gpl-license.php  GNU Public License
 *
 */
get_header('version-2');
$products = get_field('products');
$ad_freq = get_field('frequency_of_ads');

//Check if there are any daily picks  
  $dp_found = false;
  if ($products) {
    foreach ($products as $product) {
      if ($product['daily_pick']) {
        $dp_found = true;
      }
    }
  }
?>

<div id="gg2017">
  <aside id="gg2017-header-ad">
  </aside>

  <header class="gg2017-header container">
    <div class="row">
      <div class="col-xs-12 <?php if($dp_found){ echo 'col-sm-6';} ?> gg2017-header-info">
        <?php
        $header_title = get_field('header_title');
        $header_subtitle = get_field('header_subtitle');
        $header_description = get_field('header_description');
        ?>
        <h1><?php echo $header_title; ?></h1>
        <h2><?php if( $header_subtitle ): ?><?php echo $header_subtitle; ?><?php endif; ?></h2>
      </div>

      <?php if( have_rows('products') ):

        while( have_rows('products') ): the_row();

          if(get_sub_field('daily_pick')) {

            $product_name = get_sub_field('product_name');
            $url = get_sub_field('url');
            $image = get_resized_remote_image_url(get_sub_field('image'),800,500);
            $daily_pick = get_sub_field('daily_pick'); ?>

            <div class="col-xs-12 col-sm-6 gg2017-dp">
              <div class="row">
                <div class="col-xs-6">
                  <a href="<?php echo $url; ?>" target="_blank" rel="nofollow">
                    <div class="gg2017-dp-img-cont">
                      <div class="gg2017-dp-img" style="background: url(<?php echo $image; ?>);"></div>
                    </div>
                  </a>
                </div>
                <div class="col-xs-6">
                  <span>Daily Pick</span>
                  <h4><?php echo $product_name; ?></h4>
                  <a href="<?php echo $url; ?>" target="_blank" rel="nofollow" class="btn-red">Check it Out</a>
                </div>
              </div>
            </div>

          <?php
          }

        endwhile;
      endif; ?>

    </div>
    <div class="row gg2017-header-decription">
      <div class="col-xs-12">
        <h3><?php echo $header_description; ?></h3>
      </div>
    </div>

    <?php $header_banner = get_field('header_banner');
    if ($header_banner) { 
      $args = array('strip' => 'all');
      $gg_photon_banner = jetpack_photon_url($header_banner, $args); ?>
      <div class="gg2017-header-banner" style="background: url(<?php echo $gg_photon_banner; ?>?w=1600);">
        <div class="gg2017-header-banner-cont">

          <?php if( have_rows('products') ):
            while( have_rows('products') ): the_row();
              if(get_sub_field('feature_in_sponsored_product_hero')) {

                $image_2 = get_sub_field('image_2');
                $daily_pick = get_sub_field('feature_in_sponsored_product_hero');
                $gg_photon_banner_product = get_resized_remote_image_url($image_2,600,600);
                $product_name = get_sub_field('product_name');
                $product_name_sanitized = str_replace(' ', '-', strtolower($product_name));
                $product_name_sanitized = preg_replace('/[^A-Za-z0-9\-]/', '', $product_name_sanitized); // Removes special chars ?>

                <div class="gg2017-hb-product">
                  <div class="gg2017-hb-relative">
                    <a href="#<?php echo $product_name_sanitized; ?>" class="btn-link-down">
                      <img src="<?php echo $gg_photon_banner_product; ?>" class="img-responsive" alt="Featured sponsored product" />
                    </a>
                    <a href="#<?php echo $product_name_sanitized; ?>" class="gg2017-hb-title btn-link-down">
                      <div>
                        <span class="fa-stack">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-arrow-down fa-stack-1x fa-inverse"></i>
                        </span>
                      </div>
                      <p><?php echo $product_name; ?></p>
                    </a>
                  </div>
                </div>

              <?php
              }
            endwhile;
          endif; ?>

        </div>
      </div>
    <?php } ?>
  </header>

<?php 
$cats = get_field('categories_filters');
if( $cats ) { ?>
  <nav id="gg2017-nav" class="gg2017-nav">
    <div class="container">

      <div class="dropdown gg2017-dd1">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2017-cat-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span>Filter By </span>Type <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="gg2017-nav-flex dropdown-menu list-unstyled" aria-labelledby="gg2017-cat-menu">
          <li>
            <p>Find gifts for:</p>
          </li>
          <li>
            <button onclick="removeHashFunction();" id="gg-nav-all" class="btn btn-link filter" data-filter="all">All</button>
          </li>

          <?php foreach ($cats as $cat) { ?>

              <li class="gg2017-li-border"></li>
              <li>
                <a href="#<?php echo $cat['value']; ?>" class="btn btn-link filter" data-filter=".<?php echo $cat['value']; ?>"><?php echo $cat['label']; ?></a>
              </li>

          <?php } ?>

        </ul>
      </div>

      <div class="dropdown gg2017-dd2">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2017-price-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <span>Sort By </span>Price <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="gg2017-price-menu">
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
<?php } ?>

  <div id="scrollPane">
    <div id="innerDiv" class="inner">
      <div class="gg2017-body-bg">

        <div id="gg2017-js" class="gg2017-body container" itemscope itemtype="https://schema.org/ItemList">

        <?php if( have_rows('products') ): ?>

          <?php while( have_rows('products') ): the_row();

            if(!get_sub_field('sponsored')) { 

              $product_name = get_sub_field('product_name');
              $product_name_sanitized = str_replace(' ', '-', strtolower($product_name));
              $product_name_sanitized = preg_replace('/[^A-Za-z0-9\-]/', '', $product_name_sanitized);
              $product_description = get_sub_field('product_description');
              $author_name = get_sub_field('author_name');
              $author_description = get_sub_field('author_description');
              $author_image = get_resized_remote_image_url(get_sub_field('author_image'),150,150);
              $author_url = get_sub_field('author_url');
              $price = get_sub_field('price');
              $price2 = get_sub_field('price_used_for_sorting_not_shown');
              $price_color = get_sub_field('price_color');
              $url = get_sub_field('url');
              $image = get_resized_remote_image_url(get_sub_field('image'),800,500);
              $category = get_sub_field('category');
              $priceNoComma = str_replace( ',', '', $price2 );
              $ctf = get_sub_field('category_takeover_featured');
              $dp = get_sub_field('daily_pick'); ?>

              <article id="<?php echo $product_name_sanitized;?>" class="gg2017-review gg2017-review-even1 mix
              <?php if( $category ): echo implode(' ', $category); ?>
              <?php endif; ?> <?php if($ctf){ echo 'ctf-move';} ?>
              <?php if($dp){ echo 'gg2017-pd-move';} ?>" data-myorder="<?php echo round($priceNoComma); ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/Product">
                <div class="gg2017-review-flex-cont">
                  <div class="gg2017-review-details">
                    <a href="<?php echo $url; ?>" target="_blank" itemprop="url" rel="nofollow">
                      <p class="gg2017-review-price <?php if($price_color==='gg2017-light'){echo 'gg2017-light';}?>"><?php echo $price; ?></p>
                      <div style="background: url(<?php echo $image; ?>);" class="gg2017-review-img">
                      </div>
                      <h4 itemprop="name"><?php echo $product_name; ?></h4>
                      <div class="gg2017-review-btn">
                        <button href="<?php echo $url; ?>" class="btn-red">Get It</button>
                      </div>
                    </a>
                  </div>
                  <div class="gg2017-review-info">
                    <div class="gg2017-review-desc" itemprop="description"><?php echo $product_description; ?></div>
                    <?php if( $author_name ): ?>
                      <div class="gg2017-review-author">
                        <?php if( $author_image ): ?>
                          <?php if( $author_url ): echo '<a href="' . $author_url . '">'; endif; ?>
                            <div class="gg2017-review-person-image img-circle" style="background: url(<?php echo $author_image; ?>);"></div>
                          <?php if( $author_url ): echo '</a>'; endif; ?>
                        <?php endif; ?>
                        <div class="pull-left">
                          <p class="gg2017-review-person">
                            <?php if( $author_url ): echo '<a href="' . $author_url . '">'; endif; ?>
                              Recommended by <?php echo $author_name; ?>
                            <?php if( $author_url ): echo '</a>'; endif; ?>
                          </p>
                          <?php if( $author_description ): ?>
                            <p class="gg2017-review-person-description"><?php echo $author_description; ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </article>

            <?php }

          endwhile; ?>

        <?php endif; ?>

        </div><!-- #gg2017-js.gg2017-body -->
      </div><!-- .gg2017-body-bg -->
    </div>
  </div>


  <div id="gg2017-sponsors" class="container">

  <?php if( have_rows('products') ): ?>

    <?php while( have_rows('products') ): the_row();

      if(get_sub_field('sponsored')) { 

        $product_name = get_sub_field('product_name');
        $product_name_sanitized = str_replace(' ', '-', strtolower($product_name));
        $product_name_sanitized = preg_replace('/[^A-Za-z0-9\-]/', '', $product_name_sanitized);
        $product_description = get_sub_field('product_description');
        $author_name = get_sub_field('author_name');
        $author_description = get_sub_field('author_description');
        $author_image = get_resized_remote_image_url(get_sub_field('author_image'),150,150);
        $author_url = get_sub_field('author_url');
        $price = get_sub_field('price');
        $price2 = get_sub_field('price_used_for_sorting_not_shown');
        $price_color = get_sub_field('price_color');
        $url = get_sub_field('url');
        $image = get_resized_remote_image_url(get_sub_field('image'),800,500);
        $category = get_sub_field('category');
        $priceNoComma = str_replace( ',', '', $price2 );
        $ctf = get_sub_field('category_takeover_featured');
        $dp = get_sub_field('daily_pick'); ?>

        <article id="<?php echo $product_name_sanitized;?>" class="gg2017-review gg2017-review-even1 mix gg2017-sponsored
        <?php if( $category ): echo implode(' ', $category); ?> <?php endif; ?>
        <?php if($ctf){ echo 'ctf-move';} ?>
        <?php if($dp){ echo 'gg2017-pd-move';} ?>" data-myorder="<?php echo round($priceNoComma); ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/Product" style="display:inline-block;">
          <div class="gg2017-review-flex-cont">
            <div class="gg2017-review-details">
              <a href="<?php echo $url; ?>" target="_blank" itemprop="url" rel="nofollow">
                <p class="gg2017-review-price <?php if($price_color==='gg2017-light'){echo 'gg2017-light';}?>"><?php echo $price; ?></p>
                <div style="background: url(<?php echo $image; ?>);" class="gg2017-review-img">
                </div>
                <h4 itemprop="name"><?php echo $product_name; ?></h4>
                <div class="gg2017-review-btn">
                  <button href="<?php echo $url; ?>" class="btn-red">Get It</button>
                </div>
              </a>
            </div>
            <div class="gg2017-review-info">
              <div class="gg2017-review-desc" itemprop="description"><?php echo $product_description; ?></div>
              <?php if( $author_name ): ?>
                <div class="gg2017-review-author">
                  <?php if( $author_image ): ?>
                    <?php if( $author_url ): echo '<a href="' . $author_url . '">'; endif; ?>
                      <div class="gg2017-review-person-image img-circle" style="background: url(<?php echo $author_image; ?>);"></div>
                    <?php if( $author_url ): echo '</a>'; endif; ?>
                  <?php endif; ?>
                  <div class="pull-left">
                    <p class="gg2017-review-person">
                      <?php if( $author_url ): echo '<a href="' . $author_url . '">'; endif; ?>
                        Sponsored by <?php echo $author_name; ?>
                      <?php if( $author_url ): echo '</a>'; endif; ?>
                    </p>
                    <?php if( $author_description ): ?>
                      <p class="gg2017-review-person-description"><?php echo $author_description; ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </article>

      <?php }

    endwhile; ?>

  <?php endif; ?>

  </div><!-- #gg2017-sponsors -->

  <div class="container">
    <p class="text-muted text-center">The Make: Gift Guide uses affiliate links for some of our recommendations. This helps support our site and keep the gears turning.</p>
  </div>

  <div class="gg2017-back-to-top" id="gg2017-back-to-top" title="Back to top">
    <i class="fa fa-chevron-up"></i>
  </div>

</div><!-- #gg2017 -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.min.js"></script>
<script>
  // Change the URL in the address bar, and update the history
  function removeHashFunction() {
    history.pushState("", document.title, window.location.pathname);
  }

  jQuery( document ).ready(function() {

    //page scroll counter
    var box = jQuery("#scrollPane"),
    inner = jQuery("> .inner", box),
    innerOuterHeight = inner.outerHeight();
    boxHeight = box.height();
    boxOffsetTop = box.offset().top;
    boxHeight = '768px'; //page view height
    var count = 1;
    var page  = 1;

    jQuery("#scrollPane").scroll(function() {
      if(Math.abs(inner.offset().top) > page * boxHeight) {
        page++;     //increase current page count
        count++;    //increase page view count
        ga('send', 'pageview', {
          'page': location.pathname + location.hash+'/'+page
        });
      }else
      if(Math.abs(inner.offset().top) <= (page * boxHeight) - boxHeight) {
        page--;   //decrease current page
        count++;  //increase page view count
        ga('send', 'pageview', {
          'page': location.pathname + location.hash+'/'+page
        });
      }
    });
    //end page scroll counter

    var loadCount = 1;

    // Set ALL filter to url hash or default
    origFilter = 'all'; //default to all

    var hash = window.location.hash;
    if (hash != "") {
      // Check if the url hash is one of the categories, then default filtering to that
      <?php
      $categories_filters = get_field('categories_filters');
      if ($categories_filters) {
        foreach ($categories_filters as $categories_filter) { ?>
          //console.warn('<?php echo $categories_filter["value"]; ?>');
          if(hash=='#<?php echo $categories_filter["value"]; ?>') {
            origFilter = '.<?php echo $categories_filter["value"]; ?>';
          }
        <?php
        }
      } ?>
    }


    jQuery('#gg2017-sponsors').mixItUp({
      load: {
        filter: '',
        sort: 'random'
      }
    });
    jQuery('#gg2017-js').mixItUp({
      load: {
        filter: origFilter,
        sort: 'random'
      },
      callbacks: {
        onMixStart: function(state){
          //console.log('mix start');
          jQuery('#gg2017-header-ad .js-ad').remove();
          jQuery('#gg2017-js .js-ad').remove();
          jQuery('#gg2017-js .fake-leaderboard-span').remove();

          //First reset the takeover sponsor images
          jQuery('.gg2017-body-bg').css('background', 'none');
          jQuery('.gg2017-body-bg').removeClass('gg2017-active-to');
        },

        onMixEnd: function(state){
          console.warn('mix end');
          
          //If a category takeover is set and active, set images
          //Also move category sponsored product to top of list
          <?php if( have_rows('choose_a_takeover_category') ):
            while( have_rows('choose_a_takeover_category') ): the_row();
              $category = get_sub_field('category');
              $bg_sp_image = get_sub_field('full_width_background_image');
              echo "
                if (state.activeFilter == '." . $category . "') {
                  jQuery('.gg2017-body-bg').css('background', 'url(" . $bg_sp_image . ")');
                  jQuery('.gg2017-body-bg').addClass('gg2017-active-to');
                  if (state.activeSort == 'random') {
                    jQuery('.ctf-move').insertBefore('#gg2017-js .gg2017-review:first-child');
                  }
                }";
            endwhile;
          endif; ?>

          //Alternate left and right aligned product images
          if (state.activeFilter != '.mix') {
            jQuery('#gg2017-js .gg2017-review').removeClass('gg2017-review-even1');
            jQuery('#gg2017-js .gg2017-review').removeClass('gg2017-review-even2');
            jQuery('#gg2017-js .gg2017-review:visible').filter(':odd').addClass('gg2017-review-even2');
          } else {
            jQuery('#gg2017-js .gg2017-review').removeClass('gg2017-review-even2');
            jQuery('#gg2017-js .gg2017-review').addClass('gg2017-review-even1');
          }

          //console.log(state.activeFilter);

          //console.log('loadcount = ' + loadCount);

          //Only do this stuff on state changes that are not the first page load
          if (loadCount >= 3) {
            //Injecting ads after every 12 products, on state change
            jQuery('#gg2017-header-ad').append('<div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="atf"></div>');
            jQuery('#gg2017-js .gg2017-review:visible').each(function(i) {
              var modulus = (i + 1) % <?php echo $ad_freq; ?>;
              if (modulus === 0) {
                jQuery(this).after('<div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="btf"></div><span class="fake-leaderboard-span"></span>');
              }
            });
            make.gpt.loadDyn();
            //console.log('-------2nd ads injected');

            //Send GA a new page view
            // var gaURL = location.pathname + location.hash
            // ga('set', 'page', gaURL);
            // ga('send', 'pageview');
            ga('send', 'pageview', {
              'page': location.pathname + location.hash
            });
          }

          loadCount++;
          //console.log(loadCount);
          console.warn('end end');
          //console.log(state.activeFilter);

          // Check if url hash is a product, then auto scroll to that product
          <?php
          if ($products) {
            foreach ($products as $product) { 
              $productNamesFiltered = (str_replace(' ', '-', strtolower($product["product_name"]))); ?>
              console.warn('<?php echo $product["product_name"]; ?>');
              console.warn('<?php echo $productNamesFiltered; ?>');

              if(hash=='#<?php echo $productNamesFiltered; ?>') {
                // Using jQuery's animate() method to add smooth page scroll
                jQuery('html, body').animate({
                  scrollTop: jQuery(hash).offset().top-150
                }, 600);

              }
            <?php
            }
          } ?>
        },

        onMixLoad: function(state){
          console.warn('mix load');
          //Getting random mixed sponsors and inserting them into poduct order 1,5,9,13,etc
          var count = 1;
          jQuery('#gg2017-sponsors .gg2017-sponsored').each(function() {
            jQuery('#gg2017-js').mixItUp('insert', count, jQuery(this));
            jQuery(this).show();
            count += 4;
          });

          //Check if Daily Pick is also the 1st random product on the list, if so place it lower
          if ( jQuery('.gg2017-pd-move').is(':first-child') ) {
            jQuery('#gg2017-js').append(jQuery('.gg2017-pd-move'));
          }

          if ( loadCount < 3 ) {
            //Injecting ads after every 12 products, only on 1st page load
            jQuery('#gg2017-header-ad').append('<div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="atf"></div>');
            jQuery('#gg2017-js .gg2017-review').each(function(i) {
              var modulus = (i + 1) % <?php echo $ad_freq; ?>;
              if (modulus === 0) {
                jQuery(this).after('<div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="btf"></div><span class="fake-leaderboard-span"></span>');
              }
            });
            make.gpt.loadDyn();
          }
        }
      }
    });


    // Back to top button
    (function() {
      return jQuery(window).scroll(function() {
        return jQuery(window).scrollTop() > 200 ? jQuery("#gg2017-back-to-top").addClass("show") : jQuery("#gg2017-back-to-top").removeClass("show")
      }), jQuery("#gg2017-back-to-top").click(function() {
        return jQuery("html,body").animate({
          scrollTop: "0"
        })
      })
    }).call(this);


    // Sponsored product anchor link smooth scrolling
    jQuery(".btn-link-down").on('click', function(event) {
      // Make sure this.hash has a value before overriding default behavior
      if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();

        // Store hash
        var hash = this.hash;

        // Reset any filters
        jQuery('#gg-nav-all').click();

        // Using jQuery's animate() method to add smooth page scroll
        jQuery('html, body').animate({
          scrollTop: jQuery(hash).offset().top-150
        }, 600);
      }
    });


    // Navbar affix
    var affixElement = '#gg2017-nav';
    var affixPixelAjust = 51;
    if (jQuery(window).width() < 991) {
      affixPixelAjust = 0;
    }
    jQuery(affixElement).affix({
      offset: {
        // Distance of between element and top page
        top: function () {
          return (this.top = jQuery(affixElement).offset().top - affixPixelAjust)
        }
      }
    });
    jQuery(affixElement).on('affixed.bs.affix', function(){
      jQuery("#scrollPane").addClass("gg2017-header-affixed");
    });
    jQuery(affixElement).on('affixed-top.bs.affix', function(){
      jQuery("#scrollPane").removeClass("gg2017-header-affixed");
    });
    // End Navbar affix

  });
</script>

<?php get_footer(); ?>

