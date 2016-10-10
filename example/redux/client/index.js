import React from 'react'
import { render } from 'react-dom'
import { Provider } from 'react-redux'
import { createStore } from 'redux'
import App from '../common/components/App'
import configureStore from '../common/store/configureStore';

const preloadedState = window.__PRELOADED_STATE__ ? window.__PRELOADED_STATE__ : {};
const store = configureStore(preloadedState);

render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById('root')
)
