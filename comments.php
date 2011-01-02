
			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.' ); ?></p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<?php or_above_comments(); ?>
			
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number() ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

			<?php or_comment_nav(); ?>

			<ol class="commentlist">
				<?php or_list_comments(); ?>
			</ol>
			
			<?php or_comment_nav(); ?>

<?php else : // or, if we don't have comments:
	if ( ! comments_open() ) :
?>
	
	<?php or_nocomments(); ?>
	
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form(); ?>

</div><!-- #comments -->
