<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <input type="hidden" name="post_type[]" value="post" />
  <input type="hidden" name="post_type[]" value="projects" />
  <input type="hidden" name="post_type[]" value="page" /> 
  <input type="hidden" name="post_type[]" value="products" /> 
	<input type="text" class="input-medium search-query" value="" name="s" id="s" placeholder="Search" />
	<input type="submit" class="btn" id="searchsubmit" value="Search" />
</form>