<?php

$themename = "Outrigger";
$shortname = "or";

$options = array (

	array(	"name" => "Footer HTML",
			"type" => "title"),
			
	array(	"type" => "open"),
			
	array(	"name" => "HTML",
			"desc" => "Content to be displayed in the footer",
            "id" => $shortname."_footer_code",
            "type" => "textarea"),
	
	array(	"type" => "close")
	
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
    
        if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">

<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table>
		
		<?php break;
		
		case "close":
		?>
		
        </table>
        
		<?php break;
		
		case "title":
		?>
		<table><tr>
        	<td colspan="2"><h3><?php echo $value['name']; ?></h3></td>
        </tr>
                
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td valign="top"><?php echo $value['name']; ?> &nbsp;</td>
            <td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /><br />
			<span class="description"><?php echo $value['desc']; ?></span></td>
        </tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td valign="top"><?php echo $value['name']; ?> &nbsp;</td>
            <td><textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="60" rows="5"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes( get_option( $value['id'] ) ); } else { echo $value['std']; } ?></textarea><br />
			<span class="description"><?php echo $value['desc']; ?></span></td>
        </tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td valign="top"><?php echo $value['name']; ?> &nbsp;</td>
            <td><select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_option( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select><br />
			<span class="description"><?php echo $value['desc']; ?></span></td>
       </tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            	<td valign="top"><?php echo $value['name']; ?> &nbsp;</td>
                <td><?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /><br />
						<span class="description"><?php echo $value['desc']; ?></span>
                        </td>
            </tr>
            
        <?php 		break;
 
	} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin');


if ( function_exists('register_sidebar') ) {
	register_sidebar(array('name'=>'Sidebar Top',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array('name'=>'Sidebar Bottom',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}


/* WordPress Custom Menu */

add_action('init', 'register_custom_menu');
 
function register_custom_menu() {
	register_nav_menu( 'custom-menu', __( 'Custom Menu' ) );
}


/* Action Hooks */

function or_header() {
    do_action('or_header');
}


function or_page_top() {
    do_action('or_page_top');
}


function or_below_header() {
    do_action('or_below_header');
}


function or_above_content() {
    do_action('or_above_content');
}


function or_top_nav() {
    do_action('or_top_nav');
}


function or_bottom_nav() {
	if(function_exists('wp_pagenavi')) {
		wp_pagenavi(); 
	} else {
		posts_nav_link();
	} 
}


function or_image_nav() {
    do_action('or_image_nav');
}


function or_related_posts() {
    do_action('or_related_posts');
}


function or_above_comments() {
    do_action('or_above_comments');
}


function or_comment_nav() {
    do_action('or_comment_nav');
}


function or_above_commentform() {
    do_action('or_above_commentform');
}


function or_above_sidebar() {
    do_action('or_above_sidebar');
}


function or_between_sidebar() {
    do_action('or_between_sidebar');
}


function or_below_sidebar() {
    do_action('or_below_sidebar');
}


function or_above_footer() {
    do_action('or_above_footer');
}


/* Filter Hooks */

function or_title() {	
	$title = wp_title('&laquo;', false, 'right') . " " . get_bloginfo('name');
	echo apply_filters( 'or_title', $title );
}


function or_subtitle() {	
	$subtitle = '<div class="description">' . get_bloginfo('description') . '</div>';
	echo apply_filters( 'or_subtitle', $subtitle );
}


function or_page_title() {	
	  $post = $posts[0]; // Hack. Set $post so that the_date() works.
 	  /* If this is a category archive */ if (is_category()) {
		$title = '<h3 class="pagetitle">Archive for the &#8216;' . single_cat_title("", false) . '&#8217; Category</h3>';
 	  /* If this is a tag archive */ } elseif( is_tag() ) {
		$title = '<h3 class="pagetitle">Posts Tagged &#8216;' .  single_tag_title("", false) . '&#8217;</h3>';
 	  /* If this is a daily archive */ } elseif (is_day()) { 
		$title = '<h3 class="pagetitle">Archive for ' .  get_the_time('F jS, Y') . '</h3>';
 	  /* If this is a monthly archive */ } elseif (is_month()) { 
		$title = '<h3 class="pagetitle">Archive for ' . get_the_time('F, Y') . '</h3>';
 	  /* If this is a yearly archive */ } elseif (is_year()) {
		$title = '<h3 class="pagetitle">Archive for ' . get_the_time('Y') . '</h3>';
	  /* If this is an author archive */ } elseif (is_author()) {
		$title = '<h3 class="pagetitle">Author Archive</h3>';
 	  /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$title = '<h3 class="pagetitle">Blog Archives</h3>';
 	  } elseif ( is_search() ) {
		$title = '<h3>Search Results for "' . get_search_query() . '"</h3>';
	  }
	echo apply_filters( 'or_page_title', $title );
}


function or_post_title() {	
	if ( is_single() || is_page() ) {
		$title = '<h2>' . get_the_title() . '</h2>';
	} elseif ( is_home() ) {
		$title = '<h2><a href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to  '. the_title_attribute('echo=0') . '">' . get_the_title() . '</a></h2>';
	} else {
		$title = '<h2 id="post-' .  get_the_ID() . '"><a href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to  '. the_title_attribute('echo=0') . '">' . get_the_title() . '</a></h2>';
	}
	echo apply_filters( 'or_post_title', $title );
}


function or_postmeta() {
	global $id;
	
	$postmeta = '<p class="postmetadata">Posted on ';
	$postmeta .= get_the_time('F jS, Y');
	$postmeta .= ' by ';
	$postmeta .= get_the_author();
	if (current_user_can('edit_posts')) {
       	$postmeta .= ' | <a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id .'">';
   		$postmeta .= __('Edit') . '</a>';
   	}
	$postmeta .= '</p>';
	echo apply_filters( 'or_postmeta', $postmeta );
}


function or_content() {
    if (is_search()) {
		$postcontent = '<p>';
		$postcontent .= get_the_excerpt();
		$postcontent .= '</p>';
	} else {
		$postcontent = '<div class="entry">';
		$postcontent .= apply_filters('the_content',get_the_content('Read the rest of this entry &raquo;'));
		$postcontent .= wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number', 'echo' => 0));
		$postcontent .= '</div>';
	}
	echo apply_filters( 'or_content', $postcontent );
}


function or_postfooter() {
	global $id;
	
	if (is_single()) {
		// Do Not Display
	} else {
		$postfooter = '<p class="postfooter clrfix">';
		if ( comments_open() ) {
			 $postcommentnumber = get_comments_number();
			if ($postcommentnumber > '1') {
				$postfooter .= '<a href="' . get_permalink() . '#comments" class="commentnum">';
				$postfooter .= get_comments_number() . __(' Comments') . '</a>';
			} elseif ($postcommentnumber == '1') {
				$postfooter .= '<a href="' . get_permalink() . '#comments" class="commentnum">';
				$postfooter .= get_comments_number() . __(' Comment') . '</a>';
			} elseif ($postcommentnumber == '0') {
				$postfooter .= '<a href="' . get_permalink() . '#respond" class="commentnum">';
				$postfooter .= __('Leave a comment') . '</a>';
			}
		}
		$postfooter .= '</p>';
	}
	echo apply_filters( 'or_postfooter', $postfooter );
}


function or_top_nav_fn() { ?>
	<div class="navigation"><?php previous_post_link('&laquo; %link |') ?> <a href="<?php bloginfo('wpurl') ?>">Main</a> <?php next_post_link('| %link &raquo;') ?></div>
<?php } 
add_action('or_top_nav','or_top_nav_fn');


function or_image_nav_fn() { ?>
	<div class="navigation">
		<div class="alignleft"><?php previous_image_link() ?></div>
		<div class="alignright"><?php next_image_link() ?></div>
	</div>
<?php }
add_action('or_image_nav','or_image_nav_fn');


function or_related_posts_fn() {
	if(function_exists('related_posts')) {
		echo "<h3>Related Posts:</h3>\n";
		echo "<ul>\n";
		related_posts();
		echo "</ul>\n";
	}
}
add_action('or_related_posts','or_related_posts_fn');


function or_comment_nav_fn() { ?>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
<?php }
add_action('or_comment_nav','or_comment_nav_fn');


function or_footer() {
	$or_footer_code = get_option('or_footer_code');
	
	if ($or_footer_code) {
		$footer = stripslashes( $or_footer_code );
	} else { 
		$footer = '<p>' . get_bloginfo('name') . ' proudly powered by <a href="http://wordpress.org/" target="_blank">WordPress</a></p>';
	}
	
	echo apply_filters( 'or_footer', $footer );
}

?>
