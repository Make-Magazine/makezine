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
  <aside id="gg2016-header-ad">
  </aside>

  <header class="gg2016-header container">
    <div class="row">
      <div class="col-xs-12 <?php if(get_sub_field('daily_pick')){ echo 'col-sm-7 col-md-6';} ?> gg2016-header-info">
        <?php
        $header_title = get_field('header_title');
        $header_subtitle = get_field('header_subtitle');
        $header_description = get_field('header_description');
        ?>
        <h1><?php echo $header_title; ?></h1>
        <h2><?php if( $header_subtitle ): ?><?php echo $header_subtitle; ?><?php endif; ?></h2>
        <h3><?php echo $header_description; ?></h3>
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
                  <a href="<?php echo $url; ?>" target="_blank" rel="nofollow">
                    <h4><?php echo $product_name; ?></h4>
                    <p class="gg2016-dp-desc"><?php echo $product_description; ?></p>
                  </a>
                  <?php if( $author_name ): ?>
                    <p class="gg2016-dp-author">Recommended by <?php echo $author_name; ?></p>
                  <?php endif; ?>
                  <?php if( $price ): ?>
                    <p class="gg2016-dp-price"><?php echo $price; ?></p>
                  <?php endif; ?>
                  <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank" rel="nofollow">Buy</a>
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
          <span>Filter By </span>Type <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
        </button>
        <ul class="gg2016-nav-flex dropdown-menu list-unstyled" aria-labelledby="gg2016-cat-menu">
          <li>
            <button onclick="removeHashFunction();" class="btn btn-link filter" data-filter="all">All</button>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#technology" class="btn btn-link filter" data-filter=".category-tec">Technology</a>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#digital-fabrication" class="btn btn-link filter" data-filter=".category-dig">Digital Fabrication</a>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#craft&design" class="btn btn-link filter" data-filter=".category-cra">Craft &amp; Design</a>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#drones&vehicles" class="btn btn-link filter" data-filter=".category-dro">Drones &amp; Vehicles</a>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#science" class="btn btn-link filter" data-filter=".category-sci">Science</a>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#home" class="btn btn-link filter" data-filter=".category-hom">Home</a>
          </li>
          <li class="gg2016-li-border"></li>
          <li>
            <a href="#workshop" class="btn btn-link filter" data-filter=".category-wor">Workshop</a>
          </li>
        </ul>
      </div>

      <div class="dropdown gg2016-dd2">
        <button class="btn btn-link dropdown-toggle" type="button" id="gg2016-price-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <span>Sort By </span>Price <i class="fa fa-angle-down fa-lg" aria-hidden="true"></i>
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
  <div id="scrollPane">
    <div id="innerDiv" class="inner">
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
            $ctf = get_sub_field('category_takeover_featured');
            $dp = get_sub_field('daily_pick'); 
            $sponsored = get_sub_field('sponsored'); ?>

              <article class="gg2016-review gg2016-review-even1 mix <?php if($category){echo implode(' ', $category);} if($ctf){echo ' ctf-move';} if($sponsored){echo ' gg2016-sponsored';} if($ctf){echo ' ctf-move';} if($dp){echo ' gg2016-pd-move';} ?>" data-myorder="<?php echo round($priceNoComma); ?>" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
                <div class="gg2016-review-flex-cont">
                  <div class="gg2016-review-img">
                    <a href="<?php echo $url; ?>" target="_blank" itemprop="url" rel="nofollow">
                      <img src="<?php echo $image; ?>" alt="Maker Gift Guide Image" class="img-responsive" itemprop="image" />
                    </a>
                  </div>
                  <div class="gg2016-review-info">
                    <a href="<?php echo $url; ?>" target="_blank" itemprop="url" rel="nofollow">
                      <h4 itemprop="name"><?php echo $product_name; ?></h4>
                    </a>
                    <div class="gg2016-review-desc" itemprop="description"><?php echo $product_description; ?></div>
                    <?php if( $author_name ): ?>
                      <p class="gg2016-review-person">Recommended by <?php echo $author_name; ?></p>
                    <?php endif; ?>
                    <?php if( $price ): ?>
                      <p class="gg2016-review-price"><?php echo $price; ?></p>
                    <?php endif; ?>
                    <a href="<?php echo $url; ?>" class="btn-red padleft padright" target="_blank" itemprop="url" rel="nofollow">Buy</a>
                  </div>
                </div>
              </article>

          <?php endwhile; ?>

        <?php endif; ?>

        </div><!-- #gg2016-js.gg2016-body -->

      </div><!-- .gg2016-body-bg -->
    </div><!-- #innerDiv -->
  </div><!-- #scrollPane -->

  <div class="container">
    <p class="text-muted">The Make: Gift Guide uses affiliate links for some of our recommendations. This helps support our site and keep the gears turning.</p>
  </div>

  <div class="gg2016-back-to-top" id="gg2016-back-to-top" title="Back to top">
    <i class="fa fa-chevron-up"></i>
  </div>

</div><!-- #gg2016 -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.min.js"></script>
<script>
  function removeHashFunction() {
    history.pushState("", document.title, window.location.pathname);
  }

  //SHuffle function used to sort sponsored products then add into mixitup order
  function Shuffle(o) {
    for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
    return o;
  };

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
    //removeHashFunction();
    var hash = window.location.hash;

    origFilter = 'all'; //default to all
    if(hash=='#technology') {
      origFilter = '.category-tec';
      var loadCount = 3;
    }
    if(hash=='#digital-fabrication') {
      origFilter = '.category-dig';
      var loadCount = 3;
    }
    if(hash=='#craft&design') {
      origFilter = '.category-cra';
      var loadCount = 3;
    }
    if(hash=='#drones&vehicles') {
      origFilter = '.category-dro';
      var loadCount = 3;
    }
    if(hash=='#science') {
      origFilter = '.category-sci';
      var loadCount = 3;
    }
    if(hash=='#home') {
      origFilter = '.category-hom';
      var loadCount = 3;
    }
    if(hash=='#workshop') {
      origFilter = '.category-wor';
      var loadCount = 3;
    }
    //console.log(loadCount);

    jQuery('#gg2016-js').mixItUp({
      load: {
        filter: origFilter,
        sort: 'random'
      },
      callbacks: {
        onMixStart: function(state){
          console.log('mix start');

          //Remove all adds before relayout
          jQuery('#gg2016-header-ad .js-ad').remove();
          jQuery('#gg2016-js .js-ad').remove();
          jQuery('#gg2016-js .fake-leaderboard-span').remove();

          //First reset the takeover sponsor images
          jQuery('.gg2016-body-bg').css('background', 'none');
          jQuery('.gg2016-body-bg').removeClass('gg2016-active-to');

          //Put sponsors into array
          //var sponsorsArray = jQuery('#innerDiv .gg2016-sponsored').detach();
          //Shuffle the sponsors array
          //Shuffle(sponsorsArray);
        },

        onMixEnd: function(state){
          console.log('mix end');
          //If a category takeover is set and active, set images
          //Also move category sponsored product to top of list
          <?php if( have_rows('choose_a_takeover_category') ):
            while( have_rows('choose_a_takeover_category') ): the_row();
              $category = get_sub_field('category');

              if( $category == 'category-tec' ) {
                $tecBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-tec') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $tecBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              } elseif ( $category == 'category-dig' ) {
                $digBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-dig') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $digBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              } elseif ( $category == 'category-cra' ) {
                $craBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-cra') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $craBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              } elseif ( $category == 'category-dro' ) {
                $droBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-dro') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $droBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              } elseif ( $category == 'category-sci' ) {
                $sciBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-sci') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $sciBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              } elseif ( $category == 'category-hom' ) {
                $homBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-hom') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $homBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              } elseif ( $category == 'category-wor' ) {
                $worBG = get_sub_field('full_width_background_image');
                echo "
                  if (state.activeFilter == '.category-wor') {
                    jQuery('.gg2016-body-bg').css('background', 'url(" . $worBG . ")');
                    jQuery('.gg2016-body-bg').addClass('gg2016-active-to');
                    if (state.activeSort == 'random') {
                      jQuery('.ctf-move').insertBefore('#gg2016-js .gg2016-review:first-child');
                    }
                  }";
              }
            endwhile;
          endif; ?>

          //Alternate left and right aligned product images
          if (state.activeFilter != '.mix') {
            jQuery('#gg2016-js .gg2016-review').removeClass('gg2016-review-even1');
            jQuery('#gg2016-js .gg2016-review').removeClass('gg2016-review-even2');
            jQuery('#gg2016-js .gg2016-review:visible').filter(':odd').addClass('gg2016-review-even2');
          } else {
            jQuery('#gg2016-js .gg2016-review').removeClass('gg2016-review-even2');
            jQuery('#gg2016-js .gg2016-review').addClass('gg2016-review-even1');
          }

          //console.log(state.activeFilter);

          //Set the ad vars cat to the correct navigation category
          if (state.activeFilter == '.category-tec') {
            var ad_vars_cat = {
              cat: ['technology']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else if (state.activeFilter == '.category-dig') {
            var ad_vars_cat = {
              cat: ['digital-fabrication']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else if (state.activeFilter == '.category-cra') {
            var ad_vars_cat = {
              cat: ['craft-&-design']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else if (state.activeFilter == '.category-dro') {
            var ad_vars_cat = {
              cat: ['drones-&-vehicles']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else if (state.activeFilter == '.category-sci') {
            var ad_vars_cat = {
              cat: ['science']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else if (state.activeFilter == '.category-hom') {
            var ad_vars_cat = {
              cat: ['home']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else if (state.activeFilter == '.category-wor') {
            var ad_vars_cat = {
              cat: ['workshop']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          } else {
            var ad_vars_cat = {
              cat: ['']
            };
            jQuery.extend( ad_vars, ad_vars_cat );
          }

          console.log('loadcount = ' + loadCount);

          //Only do this stuff on state changes that are not the first page load
          if (loadCount >= 3) {
            //Injecting ads after every 12 products, on state change
            jQuery('#gg2016-header-ad').append('<div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="atf"></div>');
            jQuery('#gg2016-js .gg2016-review:visible').each(function(i) {
              var modulus = (i + 1) % 12;
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
          //console.log('end end');
        },

        onMixLoad: function(state){
          console.log('mix load');

          //Getting random mixed sponsors and inserting them into poduct order 1,5,9,13,etc
          var count = 1;
          jQuery('#gg2016-sponsors .gg2016-sponsored').each(function() {
            jQuery('#gg2016-js').mixItUp('insert', count, jQuery(this));
            jQuery(this).show();
            count += 4;
          });

          //Check if Daily Pick is also the 1st random product on the list, if so place it lower
          if ( jQuery('.gg2016-pd-move').is(':first-child') ) {
            jQuery('#gg2016-js').append(jQuery('.gg2016-pd-move'));
          }

          if ( loadCount < 3 ) {
            //Injecting ads after every 12 products, only on 1st page load
            jQuery('#gg2016-header-ad').append('<div class="js-ad scroll-load" data-size="[[728,90],[970,90],[320,50]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[800,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="atf"></div>');
            jQuery('#gg2016-js .gg2016-review').each(function(i) {
              var modulus = (i + 1) % 12;
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
        return jQuery(window).scrollTop() > 200 ? jQuery("#gg2016-back-to-top").addClass("show") : jQuery("#gg2016-back-to-top").removeClass("show")
      }), jQuery("#gg2016-back-to-top").click(function() {
        return jQuery("html,body").animate({
          scrollTop: "0"
        })
      })
    }).call(this);

    //scroll to top when switching categories
    jQuery("a.btn-link").click(function() {
      jQuery("#scrollPane").animate({ scrollTop: 0 }, "slow");
    });
  });
</script>


<?php get_footer(); ?>


