
<div id="sidebar">
	
	<?php or_above_sidebar(); ?>
	
	<?php if ( is_active_sidebar( 'sidebar-top' ) ) : ?>

		<?php dynamic_sidebar( 'sidebar-top' ); ?>

	<?php else : ?>

		<div class="widget">
			<h3><?php _e('Search'); ?></h3>
			<?php get_search_form(); ?>
		</div>
		
		<div class="widget">
			<h3><?php _e('Pages'); ?></h3>
			<ul>
				<?php wp_list_pages('title_li=' ); ?>
			</ul>
		</div>
		
		<div class="widget">
			<h3><?php _e('Archives'); ?></h3>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div>
		
		<div class="widget">
			<h3><?php _e('Categories'); ?></h3>
			<ul>
			<?php wp_list_categories('show_count=1&title_li='); ?>
			</ul>
		</div>
		
		<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
			<div class="widget">
				<?php wp_list_bookmarks('category_before=&category_after=&title_before=<h3>&title_after=</h3>'); ?>
			</div>
			
			<div class="widget">
				<h3><?php _e('Meta'); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</div>
		<?php } ?>

	<?php endif; ?>
	
	<?php or_between_sidebar(); ?>
	
	<?php dynamic_sidebar( 'sidebar-bottom' ); ?>
	
	<?php or_below_sidebar(); ?>
	
</div>

