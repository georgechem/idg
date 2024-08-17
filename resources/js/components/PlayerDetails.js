import React from 'react';
import InputComponent from './InputComponent';
import dayjs from 'dayjs';

const PlayerDetails = ({player, setShowMemberDetails, setCurrentPlayer}) => {

    const onClose = () => {
        setShowMemberDetails(false);
        setCurrentPlayer(null);
    }

    return(
        <div className={'playerDetails'}>
            <div className={'contentWrapper'}>
                <div className={'content'}>
                    <div className={'header'}>
                        <div>Player Details</div>
                        <div onClick={onClose}>x</div>
                    </div>
                    <div className={'line'}></div>
                    <div>
                        <div className={'contentRow'}>
                            <InputComponent
                                label={'First Name:'}
                                value={player.first_name}
                            />

                            <InputComponent
                                label={'Laste Name:'}
                                value={player.last_name}
                            />
                        </div>

                        <div className={'contentRow'}>
                            <InputComponent
                                label={'Nickname:'}
                                value={player.nickname}
                            />

                            <InputComponent
                                label={'Phone:'}
                                value={player.phone}
                            />
                        </div>

                        <div className={'contentRow'}>
                            <InputComponent
                                label={'Average Score:'}
                                value={player.average_score}
                            />

                            <InputComponent
                                label={'Email:'}
                                value={player.email}
                            />
                        </div>

                        <div className={'contentRow'}>
                            <InputComponent
                                label={'Highest score game ended:'}
                                value={dayjs(player.game_date).format('DD/MM/YYYY HH:mm:ss')}
                            />

                            <InputComponent
                                label={'Total games played:'}
                                value={player.games_played}
                            />
                        </div>

                        <div className={'contentRow'}>
                            <InputComponent
                                label={'Highest score:'}
                                value={player.highest_score}
                            />

                            <InputComponent
                                label={'Lowest score:'}
                                value={player.lowest_score}
                            />
                        </div>

                        <div className={'contentRow'}>
                            <InputComponent
                                label={'Wins:'}
                                value={player.wins}
                            />

                            <InputComponent
                                label={'Losses:'}
                                value={player.losses}
                            />
                        </div>

                        <p>Opponent in highest score game</p>

                        <div className={'contentRow'}>
                            <InputComponent
                                label={'First Name:'}
                                value={player.opponent_first_name}
                            />

                            <InputComponent
                                label={'Last Name:'}
                                value={player.opponent_last_name}
                            />
                        </div>

                        <div>
                            <div></div>
                            <button className={'button'}>Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    );
}

export default PlayerDetails;
