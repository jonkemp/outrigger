<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>

<?php or_below_header(); ?>

<div id="bd" class="clrfix">
	
	<?php or_above_content();?>
	
	<div id="content">
	
	<h2>Links:</h2>
	<ul>
	<?php wp_list_bookmarks(); ?>
	</ul>
	
	</div>
	
<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
