import React, { useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';

export const Counter = () => {
  const counter = useSelector((state) => state.value);
  const dispatch = useDispatch();

  return (
    <div>
      Value:
      <button onClick={() => dispatch({ type: 'counter/decrement' })} className="button">-</button>
      <button onClick={() => dispatch({ type: 'counter/increment' })} className="button">+</button>
      {counter}
    </div>
  )
}
