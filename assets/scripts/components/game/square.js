import React, {useState, useContext} from 'react';
import {ThemeContext} from './context';
import {useSelector} from "react-redux";

export const Square = ({value, total}) => {
  const [count, setCount] = useState(value);
  const theme = useContext(ThemeContext)
  const increment = useSelector((state) => state.value);

  const click = () => {
    setCount((state) => {
      return (state + increment) % total;
    });
  }

  return (
    <button className={'square ' + theme} onClick={() => click()}>
      {count}
    </button>
  );
}
