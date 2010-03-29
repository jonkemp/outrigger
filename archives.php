<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<?php or_below_header(); ?>

<div id="bd" class="clrfix">
	
	<?php or_above_content();?>
	
	<div id="content">
	
	<h2>Archives by Month:</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>
	
	<h2>Archives by Subject:</h2>
		<ul>
			 <?php wp_list_categories(); ?>
		</ul>
	
	</div>
	
<?php get_sidebar(); ?>

</div>

<?php or_above_footer(); ?>

<?php get_footer(); ?>
