<?php get_header();?>

<?php or_below_header(); ?>

<div id="bd" class="clrfix">
	
	<?php or_above_content();?>
	
	<div id="content">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php or_top_nav();?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<?php or_post_title(); ?>
			<?php or_postmeta(); ?>
			<div class="entry">
				<p class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
				<div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>

				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php or_image_nav(); ?>

			</div>

		</div>

	<?php comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no attachments matched your criteria.</p>

	<?php endif; ?>

	</div>
	
<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
