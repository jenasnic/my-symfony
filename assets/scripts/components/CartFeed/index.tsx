import { FunctionComponent, useState } from 'react';
import React from 'react';
import style from './CartFeed.module.scss';
import cn from 'classnames';
import { Quantity } from '../Quantity';
import { Button } from '../../ui/atoms/Button';

type Props = {
  onAdd: (reference, quantity) => void,
  classNames?: string,
}

export const CartFeed: FunctionComponent<Props> = ({onAdd, classNames = null}) => {
  const [quantity, setQuantity] = useState(1);
  const [reference, setReference] = useState('');

  const updateQuantity = (newQuantity: number) => {
    setQuantity(Math.max(1, newQuantity));
  }

  const addProduct = () => {
    onAdd(reference, quantity);
  }

  return (
    <div className={cn(style.cartFeed, classNames)}>
      <label>Ajouter un article :</label>
      <div className={style.productWrapper}>
        <input type="text" name="name" placeholder="Saisir une référence*" onChange={({target: {value}}) => setReference(value)}/>
        <Quantity quantity={quantity} onChange={updateQuantity} />
      </div>
      <Button href="#" onClick={addProduct}>Ajouter au panier</Button>
    </div>
  )
}
