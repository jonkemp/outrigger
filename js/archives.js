(function () {
  'use strict';

  var ArchivesList = React.createClass({
    render: function() {
      var items = this.props.data.map(function(item) {
        return (
          <li key={item.text}><a href={item.url}>{item.text}</a></li>
        );
      });

      return (
        <ol className="list-unstyled">
          {items}
        </ol>
      );
    }
  });

  var Archives = React.createClass({
    render: function() {
      return (
        <div>
          <h4>Archives</h4>
          <ArchivesList data={wpArchives} />
        </div>
      );
    }
  });

  ReactDOM.render(<Archives />, document.getElementById('archives'));
}());
