import React from 'react';
import {Square} from './square';

export const Board = (props) => {
  const status = 'Next player: X';

  const total = props.rowCount * props.columnCount;
  const rows = [...Array(props.rowCount)].map((value, index) => {
    return (
      <BoardRow key={index.toString()} size={props.columnCount} offset={index * props.columnCount} total={total}/>);
  });

  return (
    <div>
      <div className="status">{status}</div>
      {rows}
    </div>
  );
}

const BoardRow = (props) => {
  const columns = [...Array(props.size)].map((value, index) => {
    return (<Square key={index.toString()} value={props.offset + index} total={props.total}/>);
  });

  return (
    <div className="board-row">
      {columns}
    </div>
  );
}
