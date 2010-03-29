<?php get_header();?>

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

				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

				<?php or_postfooter(); ?>
			</div>

		<?php endwhile; ?>

		<?php or_bottom_nav();?>
		
	<?php else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif;
?>

	</div>

<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
