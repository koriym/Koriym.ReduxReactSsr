var path = require('path')
var webpack = require('webpack')

module.exports = {
  devtool: 'cheap-module-eval-source-map',
  entry: {
    react: './ssr/react-bundle',
    app: './ssr/app',
    client: './client/index'
  },
  output: {
    path: path.join(__dirname, 'public/build'),
    filename: '[name].bundle.js',
    publicPath: '/static/'
  },
  plugins: [
  ],
  module: {
    loaders: [{
      test: /\.js$/,
      loaders: ['babel'],
      exclude: /node_modules/,
      include: __dirname
    }]
  }
}
