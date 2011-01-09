<?php

add_action( 'after_setup_theme', 'or_theme_setup' );

/**
 * Outrigger custom functions
 */
 
function or_theme_setup() {
	add_theme_support('automatic-feed-links');
	
	add_action('init','remove_or_actions');
	add_action('init', 'register_custom_menu');
	add_action( 'widgets_init', 'or_widgets_init' );

	add_action('admin_menu', 'or_add_admin');
}

function remove_or_actions() {
 	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
}

function or_header() {
    do_action('or_header');
}

function or_title() {	
	$title = wp_title('&laquo;', false, 'right') . " " . get_bloginfo('name');
	echo apply_filters( 'or_title', $title );
}

function or_page_top() {
    do_action('or_page_top');
}

function or_subtitle() {	
	$subtitle = '<div class="description">' . get_bloginfo('description') . '</div>';
	echo apply_filters( 'or_subtitle', $subtitle );
}

function or_below_header() {
    do_action('or_below_header');
}

function or_custom_menu() {
	if ( function_exists('wp_nav_menu') ) {
		wp_nav_menu( array( 'theme_location' => 'custom-menu', 'container_class' => 'menu clrfix', 'menu_class' => '', 'fallback_cb' => '' ) );
	}
}
add_action('or_below_header', 'or_custom_menu');

function or_above_content() {
    do_action('or_above_content');
}

function or_page_title() {	
	  $post = $posts[0]; // Hack. Set $post so that the_date() works.
 	  /* If this is a category archive */ if (is_category()) {
		$title = '<h3 class="pagetitle">' . __('Archive for the &#8216;') . single_cat_title("", false) . __('&#8217; Category') . '</h3>';
 	  /* If this is a tag archive */ } elseif( is_tag() ) {
		$title = '<h3 class="pagetitle">' . __('Posts Tagged &#8216;') .  single_tag_title("", false) . __('&#8217;') . '</h3>';
 	  /* If this is a daily archive */ } elseif (is_day()) { 
		$title = '<h3 class="pagetitle">' . __('Archive for ') .  get_the_time('F jS, Y') . '</h3>';
 	  /* If this is a monthly archive */ } elseif (is_month()) { 
		$title = '<h3 class="pagetitle">' . __('Archive for ') . get_the_time('F, Y') . '</h3>';
 	  /* If this is a yearly archive */ } elseif (is_year()) {
		$title = '<h3 class="pagetitle">' . __('Archive for ') . get_the_time('Y') . '</h3>';
	  /* If this is an author archive */ } elseif (is_author()) {
		$title = '<h3 class="pagetitle">' . __('Author Archive') . '</h3>';
 	  /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$title = '<h3 class="pagetitle">' . __('Blog Archives') . '</h3>';
 	  } elseif ( is_search() ) {
		$title = '<h3>' . __('Search Results for "') . get_search_query() . __('"') . '</h3>';
	  }
	echo apply_filters( 'or_page_title', $title );
}

function or_top_nav() {
    do_action('or_top_nav');
}

function or_top_nav_fn() { ?>
	<div class="navigation"><?php previous_post_link('&laquo; %link |') ?> <a href="<?php bloginfo('wpurl') ?>"><?php _e('Main'); ?></a> <?php next_post_link('| %link &raquo;') ?></div>
<?php } 
add_action('or_top_nav','or_top_nav_fn');

function or_post() {	
	global $id;
	
	or_post_title();
	
	or_postmeta();
	
	or_content();
	
	or_postfooter();
}

function or_post_title() {	
	if ( is_single() || is_page() ) {
		$title = '<h2>' . get_the_title() . '</h2>';
	} elseif ( is_home() ) {
		$title = '<h2><a href="' . get_permalink() . __('" rel="bookmark" title="Permanent Link to  ') . the_title_attribute('echo=0') . '">' . get_the_title() . '</a></h2>';
	} else {
		$title = '<h2 id="post-' .  get_the_ID() . '"><a href="' . get_permalink() . __('" rel="bookmark" title="Permanent Link to  ') . the_title_attribute('echo=0') . '">' . get_the_title() . '</a></h2>';
	}
	echo apply_filters( 'or_post_title', $title );
}

function or_postmeta() {
	global $id;
	
	if ( !is_page() ) {
		$postmeta = '<p class="postmetadata">' . __('Posted on ');
		$postmeta .= get_the_time('F jS, Y');
		$postmeta .= __(' by ');
		$postmeta .= get_the_author();
		if (current_user_can('edit_posts')) {
	       	$postmeta .= ' | <a href="' . get_bloginfo('wpurl') . '/wp-admin/post.php?action=edit&amp;post=' . $id .'">';
	   		$postmeta .= __('Edit') . '</a>';
	   	}
		$postmeta .= '</p>';
	}
	echo apply_filters( 'or_postmeta', $postmeta );
}

function or_content() {
    if ( is_search() ) {
		$postcontent = '<p>';
		$postcontent .= get_the_excerpt();
		$postcontent .= '</p>';
	} else if ( is_archive() ) {
		$postcontent = '<div class="entry">';
		$postcontent .= get_the_excerpt();
		$postcontent .= '</div>';
	} else if ( is_attachment() ) {
		$postcontent = '<div class="entry">';
		$postcontent .= '<p class="attachment"><a href="';
		$postcontent .= wp_get_attachment_url($post->ID);
		$postcontent .= '">';
		$postcontent .= wp_get_attachment_image( $post->ID, 'medium' );
		$postcontent .= '</a></p>';
		$postcontent .= '<div class="caption">';
		if ( !empty($post->post_excerpt) ) {
			$postcontent .= get_the_excerpt(); // this is the "caption"
		}
		$postcontent .= '</div>';
		$postcontent .= get_the_content('<p>Continue reading &raquo;</p>');
		$postcontent .= '</div>';
	} else {
		$postcontent = '<div class="entry">';
		$postcontent .= apply_filters( 'the_content', get_the_content('<p>Continue reading &raquo;</p>'));
		$postcontent .= wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number', 'echo' => 0 ) );
		$postcontent .= '</div>';
	}
	echo apply_filters( 'or_content', $postcontent );
}

function or_postfooter() {
	if (!is_singular()) {
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

function or_related_posts() {
    do_action('or_related_posts');
}

function or_related_posts_fn() {
	if(function_exists('related_posts')) {
		echo "<h3>" . __('Related Posts:') . "</h3>\n";
		echo "<ul>\n";
		related_posts();
		echo "</ul>\n";
	}
}
add_action('or_related_posts','or_related_posts_fn');

function or_image_nav() {
    do_action('or_image_nav');
}

function or_image_nav_fn() { ?>
	<div class="navigation clrfix">
		<div class="alignleft"><?php previous_image_link() ?></div>
		<div class="alignright"><?php next_image_link() ?></div>
	</div>
<?php }
add_action('or_image_nav','or_image_nav_fn');

function or_above_comments() {
    do_action('or_above_comments');
}

function or_list_comments() {
	$or_avatar_size = get_option('or_avatar_size');
	
	if ($or_avatar_size) {
		$args = 'avatar_size=' . $or_avatar_size . '&callback=or_comment';
		wp_list_comments($args);
	} else { 
		wp_list_comments( array( 'callback' => 'or_comment' ) );
	}
}

function or_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}

function or_comment_nav() {
    do_action('or_comment_nav');
}

function or_comment_nav_fn() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<div class="navigation">
					<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&laquo;</span> Older Comments' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&raquo;</span>' ) ); ?></div>
				</div><!-- .navigation -->
	<?php endif; // check for comment navigation
}
add_action('or_comment_nav','or_comment_nav_fn');

function or_nocomments() {
	$nocomments = '<p class="nocomments">' . __('Comments are closed.') . '</p>';
	echo apply_filters( 'or_nocomments', $nocomments );
}

function or_bottom_nav() {
	if ( function_exists('wp_pagenavi') ) {
		wp_pagenavi(); 
	} else {
		echo "<div class=\"navigation\">";
		posts_nav_link();
		echo "</div>\n";
	} 
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

function or_footer() {
	$or_footer_code = get_option('or_footer_code');
	
	if ($or_footer_code) {
		$footer = stripslashes( $or_footer_code );
	} else { 
		$footer = '<p>' . get_bloginfo('name') . __(' proudly powered by <a href="http://wordpress.org/" target="_blank">WordPress</a></p>');
	}
	
	echo apply_filters( 'or_footer', $footer );
}

/**
 * Register sidebars
 */

function or_widgets_init() {
	register_sidebar(array(
		'id' => 'sidebar-top',
		'name' => __( 'Sidebar Top' ),
		'description' => __( 'The first sidebar widget area' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'id' => 'sidebar-bottom',
		'name' => __( 'Sidebar Bottom' ),
		'description' => __( 'The second sidebar widget area' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

/**
 * Register custom menu
 */
 
function register_custom_menu() {
	if ( function_exists('register_nav_menu') ) {
		register_nav_menu( 'custom-menu', __( 'Custom Menu' ) );
	}
}

/**
 * Theme options admin page
 */

function or_add_admin() {

    global $or_themename, $or_shortname, $or_options;
	
	$or_themename = "Outrigger";
	$or_shortname = "or";
	
	$or_options = array (
	
		array(	"name" => "Footer HTML",
				"type" => "title"),
				
		array(	"type" => "open"),
				
		array(	"name" => "HTML",
				"desc" => "Content to be displayed in the footer",
				"id" => $or_shortname."_footer_code",
				"type" => "textarea"),
		
		array(	"type" => "close"),
		
		array(	"name" => "Comment Options",
				"type" => "title"),
				
		array(	"type" => "open"),
	
		array(	"name" => "Gravatar Size:",
				"desc" => " px &nbsp; Size of gravatar in the user listings.",
				"id" => $or_shortname."_avatar_size",
				"type" => "number"),
		
		array(	"type" => "close")
		
	);

    if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
    
        if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {

                foreach ($or_options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($or_options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        }
    }

    add_theme_page($or_themename." Options", "".$or_themename." Options", 'edit_themes', basename(__FILE__), 'or_admin');

}

function or_admin() {

    global $or_themename, $or_shortname, $or_options;

    if ( isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade"><p><strong>' . $or_themename . __(' settings saved.</strong></p></div>');
    
?>
<div class="wrap">
<h2><?php echo $or_themename . __(' settings'); ?></h2>

<form method="post">

<?php foreach ($or_options as $value) { 
    
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
		
		case 'number':
		?>
        
        <tr>
            <td valign="top"><?php echo $value['name']; ?> &nbsp;</td>
            <td><input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" size="3" value="<?php if ( get_option( $value['id'] ) != "") { echo get_option( $value['id'] ); } else { echo $value['std']; } ?>" /> <?php echo $value['desc']; ?></td>
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

?>