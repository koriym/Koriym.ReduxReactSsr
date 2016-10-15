var path = require('path')
var webpack = require('webpack')

module.exports = {
  devtool: 'cheap-module-eval-source-map',
  entry: {
    react: './ssr/react-bundle',
    helloworld: './ssr/helloworld',
  },
  output: {
    path: path.join(__dirname, 'public/build'),
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
