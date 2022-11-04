import '../styles/app.scss';

import { legacy_createStore as createStore} from 'redux'
import React from 'react';
import * as ReactDOM from 'react-dom/client';
import { Counter } from './components/redux/counter';
import { Game } from './components/game/game';
import { Provider } from 'react-redux';

const root = ReactDOM.createRoot(document.getElementById('root'));

const initialState = { value: 1, other: 3, text: 'toto' };

function counterReducer(state = initialState, action) {
  if (action.type === 'counter/increment') {
    return {
      ...state,
      value: state.value + 1
    };
  } else if (action.type === 'counter/decrement') {
    return {
      ...state,
      value: state.value - 1
    };
  }

  return state;
}

const store = createStore(counterReducer);

root.render(
  <Provider store={store}>
    <Counter />
    <Game rowCount={3} columnCount={3} />
  </Provider>
);
