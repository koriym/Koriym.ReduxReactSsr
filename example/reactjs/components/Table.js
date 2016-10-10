var Table = React.createClass({
  render: function () {
    var rows = this.props.data.map(function (row) {
      var cells = row.map(function(cell) {
        return <td>{cell}</td>;
      });

      return <tr>{cells}</tr>;
    });

    return (
      <table>
        <tbody>{rows}</tbody>
      </table>
    );
  }
});

global