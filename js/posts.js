(function () {
  'use strict';

  var BlogPost = React.createClass({
  render: function() {
      var post = this.props.post;

      return (
        <div id={post.id} className="blog-post">
          <h2 className="blog-post-title">{post.title.rendered}</h2>
          <p className="blog-post-meta">{post.date} by <a href={post._links.author[0].href}>{post.author}</a></p>
          <div dangerouslySetInnerHTML={{__html: post.content.rendered}} />
        </div>
      );
    }
});

  var BlogPosts = React.createClass({
    render: function() {
      var blogPosts = this.props.posts.map(function(post) {
        return (
          <BlogPost key={post.id} post={post} />
        );
      });
      return (
        <div>
          {blogPosts}
        </div>
      );
    }
  });

  var BlogApp = React.createClass({
    render: function() {
      return (
        <BlogPosts posts={wpPosts} />
      );
    }
  });

  ReactDOM.render(
    <BlogApp />,
    document.getElementById('content')
  );
}());
