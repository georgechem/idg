import React from 'react';

const Row = ({player, onClick}) => {
    return (
        <tr
            onClick={onClick}
            className={'row'}
        >
            <td>{player.first_name}</td>
            <td>{player.last_name}</td>
            <td>{parseFloat(player.average_score).toFixed(2)}</td>
        </tr>
    )
}

export default Row;
