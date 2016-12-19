<?php
/**
 * This is the old blog page template
 * Currently not being used. Refer to home.php for the blog page template.
 */ ?>
<div class="container all-stories">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="all-story">All Stories</h1>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 all-post-wrapper">
			<ul class="post-list">
				<li class="row post">
					<?php blog_output($offset=0); ?>
				</li>
			</ul>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 aside">
			<div class="sidebar-wrapper">
				<?php dynamic_sidebar('sidebar_blog_page'); ?>
			</div>
		</div>

	</div>
</div>
