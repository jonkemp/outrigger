<?php get_header(); ?>

<?php or_below_header(); ?>

<div id="bd" class="clrfix">
	
	<?php or_above_content();?>
	
	<div id="content">

	<?php if (have_posts()) : ?>
		
		<?php if ( is_archive() || is_search() ) {
			or_page_title();
		} ?>
		
		<?php while (have_posts()) : the_post(); ?>

			<?php if ( is_attachment() ) {
				or_top_nav();
			?>
			
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<?php or_post(); ?>
					
					<?php or_image_nav(); ?>
				</div>

			<?php } else if ( is_single() ) {
				or_top_nav();
			?>
			
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<?php or_post(); ?>
				
					<?php or_related_posts(); ?>
				</div>
		
				<?php comments_template( '', true );

			} else { ?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

					<?php or_post(); ?>

				</div>

			<?php } ?>
		
		<?php endwhile; ?>

		<?php if ( !is_singular() ) {
			or_bottom_nav();
		} ?>

	<?php else : ?>

		<?php if ( is_category() ) { // If this is a category archive
			printf(__("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>"), single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			_e("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf(__("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>"), $userdata->display_name);
		} else if ( is_attachment() ) {
			_e("<p>Sorry, no attachments matched your criteria.</p>");
		} else {
			_e("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form(); ?>

	<?php endif; ?>
	
	<?php if ( is_page() ) {
		edit_post_link('Edit this entry.', '<p id="edit-page">', '</p>');
	} ?>

	</div>

<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
