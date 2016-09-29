<article <?php post_class('media'); ?>>

	<a href="<?php the_permalink(); ?>" class="pull-left">
		<?php echo the_post_thumbnail('archive-thumb'); ?>
	</a>

	<div class="media-body">

		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<div class="meta"><?php the_time('m/d/Y'); ?></div>

		<div class="media-body">
			<p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?> <a href="<?php the_permalink(); ?>"></a></p>
		</div>

	</div>

</article>
