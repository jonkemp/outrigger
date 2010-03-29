<?php get_header(); ?>

<?php or_below_header(); ?>

<div id="bd" class="clrfix">
	
	<?php or_above_content();?>
	
	<div id="content">

	<?php if (have_posts()) : ?>

		<?php or_page_title(); ?>

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?>>
				<?php or_post_title(); ?>
				<?php or_postmeta(); ?>
				<?php or_content(); ?>
				<?php or_postfooter(); ?>
			</div>

		<?php endwhile; ?>

		<?php or_bottom_nav();?>
		
	<?php else : ?>

		<h2 class="center">No posts found. Try a different search?</h2>
		<?php get_search_form(); ?>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
