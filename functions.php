<?php

add_action( 'after_setup_theme', 'or_theme_setup' );

/**
 * Outrigger custom functions
 */

function or_theme_setup() {
	add_action('init', 'register_custom_menu');
}

function get_siteinfo() {
  $name = get_bloginfo('name');
  $description = get_bloginfo('description');
	$url = get_bloginfo('url');

  $arr = array();
  $arr['name'] = $name;
  $arr['description'] = $description;
  $arr['url'] = $url;

  return json_encode($arr);
}

add_action('rest_api_init', function () {
	register_rest_route('wp/v2', '/site', array(
		'methods' => 'GET',
		'callback' => 'get_siteinfo',
	));
});

/**
 * Register custom menu
 */

function register_custom_menu() {
	if ( function_exists('register_nav_menu') ) {
		register_nav_menu( 'custom-menu', __( 'Custom Menu' ) );
	}
}

/**
 * Custom function for displaying archives
 */

function or_get_archives( $args = '' ) {
	global $wpdb, $wp_locale;

	$defaults = array(
		'type' => 'monthly', 'limit' => '',
		'format' => 'html', 'before' => '',
		'after' => '', 'show_post_count' => false,
		'echo' => 1, 'order' => 'DESC',
		'post_type' => 'post'
	);

	$r = wp_parse_args( $args, $defaults );

	$post_type_object = get_post_type_object( $r['post_type'] );
	if ( ! is_post_type_viewable( $post_type_object ) ) {
		return;
	}
	$r['post_type'] = $post_type_object->name;

	if ( '' == $r['type'] ) {
		$r['type'] = 'monthly';
	}

	if ( ! empty( $r['limit'] ) ) {
		$r['limit'] = absint( $r['limit'] );
		$r['limit'] = ' LIMIT ' . $r['limit'];
	}

	$order = strtoupper( $r['order'] );
	if ( $order !== 'ASC' ) {
		$order = 'DESC';
	}

	// this is what will separate dates on weekly archive links
	$archive_week_separator = '&#8211;';

	$sql_where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $r['post_type'] );

	/**
	 * Filter the SQL WHERE clause for retrieving archives.
	 *
	 * @since 2.2.0
	 *
	 * @param string $sql_where Portion of SQL query containing the WHERE clause.
	 * @param array  $r         An array of default arguments.
	 */
	$where = apply_filters( 'getarchives_where', $sql_where, $r );

	/**
	 * Filter the SQL JOIN clause for retrieving archives.
	 *
	 * @since 2.2.0
	 *
	 * @param string $sql_join Portion of SQL query containing JOIN clause.
	 * @param array  $r        An array of default arguments.
	 */
	$join = apply_filters( 'getarchives_join', '', $r );

	$output = '';

	$last_changed = wp_cache_get( 'last_changed', 'posts' );
	if ( ! $last_changed ) {
		$last_changed = microtime();
		wp_cache_set( 'last_changed', $last_changed, 'posts' );
	}

	$limit = $r['limit'];

	$query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
	$key = md5( $query );
	$key = "wp_get_archives:$key:$last_changed";
	if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
		$results = $wpdb->get_results( $query );
		wp_cache_set( $key, $results, 'posts' );
	}
	if ( $results ) {
		$after = $r['after'];
		foreach ( (array) $results as $result ) {
			$url = get_month_link( $result->year, $result->month );
			/* translators: 1: month name, 2: 4-digit year */
			$text = sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $result->month ), $result->year );

      $result->url = $url;
      $result->text = $text;
		}
    return $results;
	}
}

?>
