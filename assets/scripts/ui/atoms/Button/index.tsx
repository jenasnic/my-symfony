import React from 'react';
import cn from 'classnames';
import { FunctionComponent } from 'react';
import style from './button.module.scss';

type ButtonProps = {
  href: string,
  mainColor?: boolean,
  corner?: boolean,
  cornerType?: string,
  children?: React.ReactNode,
  className?: any,
  target?: string,
  onClick?: (e) => void,
}

export const Button: FunctionComponent<ButtonProps> = ({ href, target, mainColor = false, corner = false, cornerType = "classic", className, children, onClick }) => {
  const classNames = cn(
    style.button,
    {
      [style.mainColor]: mainColor,
      [style.corner]: corner,
      [style.cornerClassic]: cornerType === "classic"
    },
    className,
  );

  return (
    <button onClick={(e) => onClick && onClick(e)} className={classNames}>
      { children }
    </button>
  )
}
