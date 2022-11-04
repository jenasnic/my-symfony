import React, { FunctionComponent } from 'react';
import style from './Quantity.module.scss';
import cn from 'classnames';

type Props = {
  quantity: number,
  onChange: (newQuantity: number) => void,
  step?: number,
  classNames?: string,
}

export const Quantity: FunctionComponent<Props> = ({quantity, onChange, step = 1, classNames = null}) => {
  return (
    <div className={cn(style.quantity, classNames)}>
      <span className={style.button} onClick={() => onChange(quantity - step)}>-</span>
      <span className={style.value}>{quantity}</span>
      <span className={style.button} onClick={() => onChange(quantity + step)}>+</span>
    </div>
  )
}
