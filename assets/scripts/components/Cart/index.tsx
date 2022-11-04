import React, { FunctionComponent, useEffect, useState } from 'react';
import style from './Cart.module.scss';
import cn from 'classnames';
import { Button } from '../../ui/atoms/Button';
import { CartFeed } from '../CartFeed';
import { CartItem } from '../CartItem';
import { CartTotal } from '../CartTotal';
import { Icon } from '../../ui/atoms/Icon';
import { formatAmount } from '../../tools/amountFormatter';
import { findProductByRef } from '../../data/product';

type Props = {
  defaultCartItems?: CartItem[],
  classNames?: string,
}

const freeShippingLimit = 50000;

export const Cart: FunctionComponent<Props> = ({defaultCartItems, classNames = null}) => {
  const [cartItems, setCartItems] = useState<CartItem[]>(defaultCartItems || []);
  const [amount, setAmount] = useState<number>(0);
  const [shipping, setShipping] = useState<number>(0);

  useEffect(() => {
    recalculateTotal(cartItems);
  }, [cartItems]);

  const recalculateTotal = (cartItems: CartItem[]) => {
    const {amount, quantity} = cartItems.reduce(({amount, quantity}, productWithWQuantity) => {
      return {
        amount: amount + productWithWQuantity.quantity * productWithWQuantity.product.price.current,
        quantity: quantity + productWithWQuantity.quantity,
      };
    }, {amount: 0, quantity: 0});

    setAmount(amount);
    setShipping(200 * quantity);
  };

  const onAddProduct = (reference, quantity) => {
    const product = findProductByRef(reference);
    if (product) {
      // @todo : check if product already exist in cart + check availability (i.e. stock of product)
      const updatedProducts = [...cartItems, {product: product, quantity: quantity}];
      setCartItems(updatedProducts);
    }
  }

  const onRemoveProduct = (productId) => {
    const updatedProducts = cartItems.filter(({product}) => product.id !== productId);
    setCartItems(updatedProducts);
  }

  const onChangeProductQuantity = (productId: number, newQuantity: number) => {
    const updatedProducts:CartItem[] = cartItems.map((productWithQuantity) => {
      if (productWithQuantity.product.id !== productId) {
        return productWithQuantity;
      }

      return {...productWithQuantity, quantity: Math.max(1, Math.min(newQuantity, productWithQuantity.product.stock.quantity))};
    });

    setCartItems(updatedProducts);
  }

  const onAskQuote = () => {
    console.log('Demande de devis');
  };

  const onConfirmOrder = () => {
    console.log('Confirmation de commande');
  };

  return (
    <div className={cn(style.cart, classNames)}>
      <div className={style.content}>
        <CartFeed onAdd={onAddProduct} />
        <div className={style.contentList}>
          {cartItems.map((cartItem) => {
            return <CartItem
              cartItem={cartItem}
              onChangeQuantity={onChangeProductQuantity}
              onRemove={onRemoveProduct}
              key={cartItem.product.id}
            />
          })}
        </div>
      </div>
      <div className={style.resume}>
        <div>
          <CartTotal amount={amount} shipping={shipping} tax={1960} />
          <div className={style.resumeAction}>
            <Button href="#" mainColor={true} onClick={onAskQuote}>Demander un devis</Button>
            <Button href="#" onClick={onConfirmOrder}>Passer la commande</Button>
          </div>
        </div>
        { amount < freeShippingLimit && <div className={style.shippingNote}>
          <Icon icon="info"></Icon>
          <span>Plus que { formatAmount(freeShippingLimit - amount) }€ pour bénéficier du Franco de port.</span>
        </div>}
      </div>
    </div>
  )
}
