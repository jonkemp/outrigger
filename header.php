<?php or_header(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php or_title(); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php if ( is_singular() && get_option( 'thread_comments' ) )
	wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<?php or_page_top(); ?>

<div id="doc">

<div id="hd">
	<div id="branding">
		<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<?php or_subtitle(); ?>
	</div>
</div>
