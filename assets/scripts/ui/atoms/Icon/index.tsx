import React from 'react';
import cn from 'classnames';
import { FunctionComponent } from 'react';

type IconProps = {
  icon: string,
  className?: any,
}

export const Icon: FunctionComponent<IconProps> = ({icon, className}) => {
  const classNames = cn(
    'icon',
    `icon-${icon}`,
    className
  );

  return (
    <span className={classNames}></span>
  )
}
