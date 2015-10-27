<?php
/**
 * This is a blog page template
 */ ?>
<div class="container all-stories">
	<div class="row">
		<h1 class="all-story">All stories</h1>
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 all-post-wrapper">
			<ul class="post-list">
				<li class="row post">
					<?php blog_output($offset=0); ?>
				</li>
			</ul>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 sidebar-wrapper">
			test sidebar
		</div>
	</div>
</div>
