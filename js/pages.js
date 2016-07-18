(function () {
  'use strict';

  var BlogPages = React.createClass({
    render: function() {
      var blogPages = this.props.data.map(function(page) {
        return (
          <a key={page.ID} className="blog-nav-item" href={page.guid}>{page.post_title}</a>
        );
      });

      return (
        <nav className="blog-nav">
          {blogPages}
        </nav>
      );
    }
  });

  var TopNav = React.createClass({
    render: function() {
      return (
        <BlogPages data={wpPages} />
      );
    }
  });

  ReactDOM.render(<TopNav />, document.getElementById('topnav'));
}());
