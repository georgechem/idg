import React, {useState} from 'react';
import {v4 as uuid} from 'uuid';
const InputComponent = (props) => {

    const id = uuid();

    const [inputValue, setInputValue] = useState(props.value ? props.value : '');

    return (
        <div className={'inputComponent'}>
            {props.label ?
                <label
                    className={'label'}
                    htmlFor={id}
                >
                    {props.label}
                </label>
                : null}
            <input
                className={'input'}
                onChange={(e) => setInputValue(e.target.value)}
                id={id}
                value={inputValue}
            />
        </div>
    );
}

export default InputComponent;
