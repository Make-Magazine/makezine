<?php
/**
 * @package MakeZine
 * Template Name: iTunes RSS Feed
*/
header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/" 
	xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
	<?php do_action('rss2_ns'); ?>
>
<channel>
	<title>MAKE Magazine</title>
	<atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
	<link><?php bloginfo_rss('url') ?></link>
	<description><?php bloginfo_rss("description") ?></description>
	<lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
	<language><?php echo get_option('rss_language'); ?></language>
	<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
	<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
    <itunes:author>O'Reilly Media, Inc.</itunes:author>
    <itunes:subtitle>Technology on Your Time</itunes:subtitle>
    <itunes:summary>Join MAKE magazine for a Weekend project each week you can build yourself! MAKE is a quarterly publication from O'Reilly for those who just can't stop tinkering, disassembling, re-creating, and inventing cool new uses for the technology in our lives. It's the first do-it-yourself magazine dedicated to the incorrigible and chronically incurable technology enthusiast in all of us. MAKE celebrates your right to tweak, hack, and bend technology any way you want. MAKE on iTunes is produced by Kip Kay and Phillip Torrone.</itunes:summary>
    <itunes:owner>
      <itunes:email>webmaster@makezine.com</itunes:email>
    </itunes:owner>
    <itunes:category text="Technology"></itunes:category>
    <itunes:category text="Technology">
      <itunes:category text="Gadgets" />
    </itunes:category>
    <itunes:category text="Science &amp; Medicine"></itunes:category>
    <itunes:image href="http://cdn.makezine.com/make/blogs/blog.makezine.com/images/logos/rss_icon.jpg" />
    <itunes:new-feed-url>http://blog.makezine.com/category/make_podcast/feed/</itunes:new-feed-url>
    <itunes:explicit>no</itunes:explicit>
	<docs>http://www.rssboard.org/rss-specification</docs>	
	<?php do_action('rss2_head'); ?>
	<?php 
		$args=array('post_type'=>'post', 'tag'=>'make-podcast', 'showposts'=>45);
		$qry=new WP_Query($args);
		while( $qry->have_posts()) : $qry->the_post(); ?>
	<item>
		<title><?php the_title_rss() ?></title>
		<link><?php the_permalink_rss() ?></link>
		<comments><?php comments_link_feed(); ?></comments>
		<pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>	 
		<dc:creator><?php the_author() ?></dc:creator>
		<itunes:author><?php the_author(); ?></itunes:author>
		<?php the_category_rss() ?>

		<guid isPermaLink="false"><?php the_guid(); ?></guid>
<?php if (get_option('rss_use_excerpt')) : ?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
<?php else : ?>
		<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
	<?php if ( strlen( $post->post_content ) > 0 ) : ?>
		<content:encoded><![CDATA[<?php the_content_feed('rss2') ?>]]></content:encoded>
	<?php else : ?>
		<content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
	<?php endif; ?>
<?php endif; ?>
		<slash:comments><?php echo get_comments_number(); ?></slash:comments>
<?php rss_enclosure(); ?>
	<?php do_action('rss2_item'); ?>
	</item>
	<?php endwhile; ?>
</channel>
</rss>