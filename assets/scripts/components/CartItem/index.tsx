import React, { FunctionComponent } from 'react';
import style from './CartItem.module.scss';
import { Picture } from '../Picture';
import { Price } from '../Price';
import { Quantity } from '../Quantity';
import { Stock } from '../Stock';

type Props = {
  cartItem: CartItem
  onChangeQuantity: (productId: number, newQuantity: number) => void
  onRemove: (productId: number) => void
};

export const CartItem: FunctionComponent<Props> = ({cartItem, onChangeQuantity, onRemove}) => {
  const {product, quantity} = cartItem;

  return (
    <div className={style.cartItem}>
      <Picture url={product.picture} alt={product.reference} classNames={style.picture} />
      <div className={style.detail}>
        <span className={style.close} onClick={() => onRemove(product.id)}></span>
        <div className={style.product}>
          <div className={style[`product--brand`]}>{product.brand}</div>
          <div className={style[`product--description`]}>{product.shortDescription}</div>
          <div className={style[`product--reference`]}>REF : {product.reference}</div>
        </div>
        <div className={style.info}>
          <div className={style.quantity}>
            <Stock quantity={product.stock.quantity} restocking={product.stock.state == 'restocking'}/>
            <Quantity
              quantity={quantity}
              onChange={(newQuantity) => onChangeQuantity(product.id, newQuantity)}
            />
          </div>
          <div className={style.price}>
            <span>Tarif conseillé : <Price value={product.price.recommended} currency="€" classNames={style.recommendedPrice}/></span>
            <Price value={product.price.current} currency="€" classNames={style.currentPrice}/>
            { product.discount && <span>Remise de {product.discount}%</span> }
          </div>
        </div>
      </div>
    </div>
  )
}
