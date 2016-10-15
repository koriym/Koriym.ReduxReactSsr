import configureStore from '../common/store/configureStore';
import App from '../common/components/App';
import { Provider } from 'react-redux';

global.App = App;
global.Provider = Provider;
global.configureStore = configureStore;
