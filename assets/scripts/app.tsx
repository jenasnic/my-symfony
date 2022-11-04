import '../styles/app.scss';

import React from 'react';
import * as ReactDOM from 'react-dom/client';
import { Cart } from './components/Cart';
import { product2, product3 } from './data/product';

const root = ReactDOM.createRoot(document.getElementById('root'));

const defaultCartItems = [
  // { product: product2, quantity: 3 },
  // { product: product3, quantity: 1 },
];

root.render(
  <Cart defaultCartItems={defaultCartItems}/>
);
