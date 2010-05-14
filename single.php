<?php get_header();?>

<?php or_below_header(); ?>

<div id="bd" class="clrfix">
	
	<?php or_above_content();?>
	
	<div id="content">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php or_top_nav();?>
		
		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php or_post_title(); ?>
			<?php or_postmeta(); ?>

			<?php or_content(); ?>

			<?php or_postfooter(); ?>
			
			<?php or_related_posts(); ?>
		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

	<?php endif; ?>

	</div>
	
<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
