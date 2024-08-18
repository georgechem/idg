import React, {useEffect, useState} from 'react';
import '../../sass/welcome.scss';
import Row from './Row';
import PlayerDetails from "./PlayerDetails";

function Welcome() {

    const [topPlayers, setTopPlayers] = useState([]);
    const [showMemberDetails, setShowMemberDetails] = useState(false);
    const [currentPlayer, setCurrentPlayer] = useState(null);

    useEffect(()=>{
        fetch('/players', {
            method: "GET",
            headers: {
                Accept: "application/json"
            }
        }).then(res => res.json())
            .then(res => {
                setTopPlayers(res);

            }).catch(err => {
                console.log(err);
        });
    }, []);

    const onRowClick = (player) => {
        setShowMemberDetails(true)
        setCurrentPlayer(player);
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
                            onClick={()=>onRowClick(player)}
                            key={'row_'+idx}
                            player={player}
                        />)}
                    </tbody>
                </table>
            </div>

            {showMemberDetails && currentPlayer ?
                <PlayerDetails
                    player={currentPlayer}
                    setCurrentPlayer={setCurrentPlayer}
                    setShowMemberDetails={setShowMemberDetails}
                />
                : null }
        </>
    );
}

export default Welcome;

