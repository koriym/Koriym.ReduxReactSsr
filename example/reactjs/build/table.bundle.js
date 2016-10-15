/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/build/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports) {

	eval("\"use strict\";\n\nvar Table = React.createClass({\n  displayName: \"Table\",\n\n  render: function render() {\n    var rows = this.props.data.map(function (row) {\n      var cells = row.map(function (cell) {\n        return React.createElement(\n          \"td\",\n          null,\n          cell\n        );\n      });\n\n      return React.createElement(\n        \"tr\",\n        null,\n        cells\n      );\n    });\n\n    return React.createElement(\n      \"table\",\n      null,\n      React.createElement(\n        \"tbody\",\n        null,\n        rows\n      )\n    );\n  }\n});//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiMC5qcyIsInNvdXJjZXMiOlsid2VicGFjazovLy9jb21wb25lbnRzL1RhYmxlLmpzP2FjN2MiLCJ3ZWJwYWNrOi8vLz9kNDFkIl0sInNvdXJjZXNDb250ZW50IjpbInZhciBUYWJsZSA9IFJlYWN0LmNyZWF0ZUNsYXNzKHtcbiAgcmVuZGVyOiBmdW5jdGlvbiAoKSB7XG4gICAgdmFyIHJvd3MgPSB0aGlzLnByb3BzLmRhdGEubWFwKGZ1bmN0aW9uIChyb3cpIHtcbiAgICAgIHZhciBjZWxscyA9IHJvdy5tYXAoZnVuY3Rpb24oY2VsbCkge1xuICAgICAgICByZXR1cm4gPHRkPntjZWxsfTwvdGQ+O1xuICAgICAgfSk7XG5cbiAgICAgIHJldHVybiA8dHI+e2NlbGxzfTwvdHI+O1xuICAgIH0pO1xuXG4gICAgcmV0dXJuIChcbiAgICAgIDx0YWJsZT5cbiAgICAgICAgPHRib2R5Pntyb3dzfTwvdGJvZHk+XG4gICAgICA8L3RhYmxlPlxuICAgICk7XG4gIH1cbn0pO1xuXG5cbi8qKiBXRUJQQUNLIEZPT1RFUiAqKlxuICoqIGNvbXBvbmVudHMvVGFibGUuanNcbiAqKi8iLCJ1bmRlZmluZWRcblxuXG4vKiogV0VCUEFDSyBGT09URVIgKipcbiAqKiBcbiAqKi8iXSwibWFwcGluZ3MiOiI7O0FBQUE7QUNBQTtBQUNBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUNBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFEQTtBQUlBO0FBZkEiLCJzb3VyY2VSb290IjoiIn0=");

/***/ }
/******/ ]);