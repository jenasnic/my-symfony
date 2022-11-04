import { FunctionComponent } from 'react';
import React from 'react';
import style from './CartTotal.module.scss';
import cn from 'classnames';
import { formatAmount } from '../../tools/amountFormatter';
import { Icon } from '../../ui/atoms/Icon';

type Props = {
  amount: number,
  shipping: number,
  currency?: string,
  tax: number,
  classNames?: string,
}

export const CartTotal: FunctionComponent<Props> = ({amount, shipping, currency = '€', tax, classNames = null}) => {
  const total = amount + shipping;
  const taxAmount = total * tax / 10000;

  return (
    <div className={cn(style.cartTotal, classNames)}>
      <div className={style.title}>Total</div>
      <div className={style.line}>
        <span>Sous-total HT</span>
        <span>{formatAmount(amount)} {currency}</span>
      </div>
      <div className={style.line}>
        <span className={style.withIcon}>
          Frais de port
          <Icon icon="info"></Icon>
        </span>
        <span>{formatAmount(shipping)} {currency}</span>
      </div>
      <hr/>
      <div className={cn(style.line, style['line--total-et'])}>
        <span>Total HT</span>
        <span>{formatAmount(total)} {currency}</span>
      </div>
      <div className={cn(style.line, style['line--total-tax'])}>
        <span>Total HT</span>
        <span>{formatAmount(taxAmount)} {currency}</span>
      </div>
      <div className={cn(style.line, style['line--total-it'])}>
        <span>Total TTC</span>
        <span>{formatAmount(total + taxAmount)} {currency}</span>
      </div>
    </div>
  )
}
