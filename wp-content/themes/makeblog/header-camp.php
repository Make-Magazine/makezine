<!DOCTYPE html>
<html lang="en" xmlns:fb="http://ogp.me/ns/fb#">
	<head>
		<meta charset="utf-8">
		<meta name="google-site-verification" content="tjgq9UGR8WCMZI_40j_B5wda_oVYqKyFtQW547LzMgQ" />
		<title><?php echo make_generate_title_tag(); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php echo esc_attr( make_generate_description() ); ?>" />

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="shortcut icon" href="http://1.gravatar.com/blavatar/dab43acfe30c0e28a023bb3b7a700440?s=14">

		<?php wp_head(); ?>

		<?php get_template_part('dfp'); ?>

	</head>
	<body <?php body_class('camp'); ?>>
		<?php make_popdown_menu(); ?>
		<div class="fix">
			<div id="header">
                 		
				<div class="container">	
							<div class="clear"></div>
							<h1><a href="<?php echo home_url( '/trainingcamp/' ); ?>"><img style="margin:0 auto" src="http://makezineblog.files.wordpress.com/2013/05/maker-training-camp-hdr.gif" alt="Maker Training Camp" title="Maker Training Camp" /></a></h1>			
				</div> <!-- END container -->
			</div> <!-- END header -->

			<div class="header-bottom">
				<div class="container camp-main-nav">
					<div class="btn-group nav">
					    <a class="btn btn-large" href="<?php echo home_url( '/trainingcamp/' ); ?>">Home</a>
					    <a class="btn btn-large" href="<?php echo home_url( '/trainingcamp/frequently-asked-questions/' ); ?>">FAQ</a>
				    </div>
				</div> <!-- END container -->
			</div> <!-- END header-bottom -->
		</div> <!-- END fix -->
