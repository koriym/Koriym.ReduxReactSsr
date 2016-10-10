var path = require('path')
var webpack = require('webpack')

module.exports = {
  devtool: 'cheap-module-eval-source-map',
  entry: {
    react: './react.js',
    helloworld: './components/Helloworld.jsx',
  },
  output: {
    path: path.join(__dirname, 'build'),
    filename: '[name].bundle.js',
    publicPath: '/build/'
  },
  plugins: [
  ],
  module: {
    loaders: [{
      test: /\.jsx?$/,
      loaders: ['babel'],
      exclude: /node_modules/,
      include: __dirname
    }]
  }
}
