import React from 'react';
import ReactDOM from 'react-dom';
import ReactDOMServer from 'react-dom/server';
import { Provider } from 'react-redux';
import configureStore from './store/configureStore';

global.React = React;
global.ReactDOM = ReactDOM;
global.ReactDOMServer = ReactDOMServer;
global.Provider = Provider;
global.configureStore = configureStore;
