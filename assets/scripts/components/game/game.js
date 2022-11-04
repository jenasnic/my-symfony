import React from 'react';
import {Board} from './board';

export const Game = (props) => {
  return (
    <div className="game" aria-label="toto">
      <div className="game-board">
        <Board {...props}/>
      </div>
      <div className="game-info">
        <div>{/* status */}</div>
        <ol>{/* TODO */}</ol>
      </div>
      <div className="toto">
        {props.children}
      </div>
    </div>
  );
}
