import { FunctionComponent } from 'react';
import React from 'react';
import style from './Stock.module.scss';
import cn from 'classnames';

type Props = {
  quantity: number,
  restocking?: boolean,
  classNames?: string,
}

export const Stock: FunctionComponent<Props> = ({quantity, restocking = false, classNames = null}) => {
  const infos = {
    label: 'En stock',
    state: 'available',
  };

  if (quantity <= 0) {
    infos.label = restocking ? 'En réapprovisionnement' : 'Rupture';
    infos.state = restocking ? 'restocking' : 'stock-out';
  }

  return (
    <div className={cn(style.stock, style[`stock--${infos.state}`], classNames)}>
      <span className={style.label}>{infos.label}</span>
    </div>
  )
}
