import React, {useEffect, useState} from 'react';
import '../../sass/welcome.scss';
import Row from './Row';

function Welcome() {

    const [topPlayers, setTopPlayers] = useState([]);

    useEffect(()=>{
        fetch('/players', {
            method: "GET",
            headers: {
                Accept: "application/json"
            }
        }).then(res => res.json())
            .then(res => {
                setTopPlayers(res);
                console.log(res);
            }).catch(err => {
                console.log(err);
        });
    }, []);

    const onRowClick = () => {

    }

    return (
        <>
            <h1 className={'title'}>Leader boards:</h1>
            <div className={'tableContainer'}>
                <table>
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Average Score</th>
                    </tr>
                    </thead>
                    <tbody>
                    {topPlayers.map((player, idx) =>
                        <Row
                            onClick={onRowClick()}
                            key={'row_'+idx}
                            player={player}
                        />)}
                    </tbody>
                </table>
            </div>
        </>
    );
}

export default Welcome;

