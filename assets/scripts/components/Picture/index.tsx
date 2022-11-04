import { FunctionComponent } from 'react';
import React from 'react';
import style from './Picture.module.scss';
import cn from 'classnames';

type Props = {
  url: string,
  alt: string,
  classNames?: string,
}

export const Picture: FunctionComponent<Props> = ({url, alt, classNames = null}) => {
  return (
    <div className={cn(style.picture, classNames)}>
      <img src={url} alt={alt} />
    </div>
  )
}
