"use strict";

var Table = React.createClass({
  displayName: "Table",

  render: function render() {
    var rows = this.props.data.map(function (row) {
      var cells = row.map(function (cell) {
        return React.createElement(
          "td",
          null,
          cell
        );
      });

      return React.createElement(
        "tr",
        null,
        cells
      );
    });

    return React.createElement(
      "table",
      null,
      React.createElement(
        "tbody",
        null,
        rows
      )
    );
  }
});

