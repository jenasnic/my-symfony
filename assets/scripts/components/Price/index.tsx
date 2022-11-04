import { FunctionComponent } from 'react';
import React from 'react';
import style from './Price.module.scss';
import cn from 'classnames';
import { formatAmount } from '../../tools/amountFormatter';

type Props = {
  value: number,
  currency: string,
  tax?: boolean,
  classNames?: string,
}

export const Price: FunctionComponent<Props> = ({value, currency, tax = false, classNames = null}) => {
  return (
    <div className={cn(style.price, classNames)}>
      <span>{formatAmount(value)}</span>
      <span>{currency}</span>
      <span className={style.tax}>{tax ? 'TTC' : 'HT'}</span>
    </div>
  )
}
