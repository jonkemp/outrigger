(function () {
  'use strict';

  var Header = React.createClass({
    render: function() {
      var bloginfo = this.props.data;

      return (
        <div>
          <h1 className="blog-title"><a href={bloginfo.url}>{bloginfo.name}</a></h1>
          <p className="lead blog-description">{bloginfo.description}</p>
        </div>
      );
    }
  });

  ReactDOM.render(
    <Header data={wpHeader} />,
    document.getElementById('header')
  );
}());
