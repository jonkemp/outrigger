<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php wp_title('&laquo;', true, 'right') . " " . bloginfo('name'); ?></title>

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_head(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="blog-masthead">
      <div id="topnav" class="container"></div>
<script>
var wpPages = <?php echo json_encode(get_pages(array('number' => 10))); ?>;
</script>
    </div>

    <div class="container">

      <div id="header" class="blog-header"></div>
<script>
var wpHeader = {
  "name": "<?php bloginfo('name'); ?>",
  "description": "<?php bloginfo('description'); ?>",
  "url": "<?php bloginfo('url'); ?>"
};
</script>

      <div class="row">

        <div class="col-sm-8 blog-main">
          <div id="content"></div>

<script>
var wpPosts = [
<?php while (have_posts()) : the_post(); ?>
{
    "id": <?php the_ID(); ?>,
    "date": "<?php the_time('F jS, Y'); ?>",
    "date_gmt": "2016-05-18T20:39:10",
    "guid": {
      "rendered": "<?php the_guid(); ?>"
    },
    "modified": "2016-05-18T20:39:10",
    "modified_gmt": "2016-05-18T20:39:10",
    "slug": "hello-world",
    "type": "post",
    "link": "<?php the_permalink(); ?>",
    "title": {
      "rendered": "<?php the_title(); ?>"
    },
    "content": {
      "rendered": <?php echo json_encode(get_the_content()); ?>
    },
    "excerpt": {
      "rendered": "<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n"
    },
    "author": "<?php the_author(); ?>",
    "featured_media": 0,
    "comment_status": "open",
    "ping_status": "open",
    "sticky": false,
    "format": "standard",
    "categories": [
      1
    ],
    "tags": [],
    "_links": {
      "self": [
        {
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/posts/1"
        }
      ],
      "collection": [
        {
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/posts"
        }
      ],
      "about": [
        {
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/types/post"
        }
      ],
      "author": [
        {
          "embeddable": true,
          "href": "<?php the_author_link(); ?>"
        }
      ],
      "replies": [
        {
          "embeddable": true,
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/comments?post=1"
        }
      ],
      "version-history": [
        {
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/posts/1/revisions"
        }
      ],
      "wp:attachment": [
        {
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/media?parent=1"
        }
      ],
      "wp:term": [
        {
          "taxonomy": "category",
          "embeddable": true,
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/categories?post=1"
        },
        {
          "taxonomy": "post_tag",
          "embeddable": true,
          "href": "http://localhost:8888/wordpress/wp-json/wp/v2/tags?post=1"
        }
      ],
    }
  }<?php if (($wp_query->current_post +1) != ($wp_query->post_count)) : ?>,
  <?php endif; ?>
	<?php endwhile; ?>
];
</script>
          <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>
        </div>

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->

          <div id="archives" class="sidebar-module"></div>
<script>
var wpArchives = <?php echo json_encode(or_get_archives()); ?>;
</script>

          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
<script>
/*
var wpBookmarks = <?php wp_nav_menu(array('menu'=>'Project Nav','echo'=>true)); ?>;
*/
</script>

        </div><!-- /.blog-sidebar -->
      </div>
    </div>

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <?php wp_footer(); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/wordpress/wp-content/themes/outrigger/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.2/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/15.0.2/react-dom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.34/browser.min.js"></script>
    <!-- <script src="/wordpress/wp-content/themes/outrigger/js/main.js"></script> -->
    <script type="text/babel" src="/wordpress/wp-content/themes/outrigger/js/header.js"></script>
    <script type="text/babel" src="/wordpress/wp-content/themes/outrigger/js/posts.js"></script>
    <script type="text/babel" src="/wordpress/wp-content/themes/outrigger/js/pages.js"></script>
    <script type="text/babel" src="/wordpress/wp-content/themes/outrigger/js/archives.js"></script>
  </body>
</html>
