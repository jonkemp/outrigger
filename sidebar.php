
<div id="sidebar">
	
	<?php or_above_sidebar(); ?>
	
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Top') ) : ?>
		
		<li><?php get_search_form(); ?></li>
		
		<?php wp_list_pages('title_li=<h3>Pages</h3>' ); ?>

		<h3>Archives</h3>
		<ul>
		<?php wp_get_archives('type=monthly'); ?>
		</ul>

		<?php wp_list_categories('show_count=1&title_li=<h3>Categories</h3>'); ?>
		
		<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
			<?php wp_list_bookmarks(); ?>

			<h3>Meta</h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
				<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
				<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
				<?php wp_meta(); ?>
			</ul>
		<?php } ?>
		
	<?php endif; ?>
	
	<?php or_between_sidebar(); ?>

	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Bottom') ) : ?>
	
	<?php endif; ?>
	
	<?php or_below_sidebar(); ?>
	
</div>

