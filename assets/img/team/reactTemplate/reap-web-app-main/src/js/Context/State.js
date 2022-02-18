import React from 'react';
import Reducer from './Reducer';

const AppContext = React.createContext();
export let dispatcher, appState;
export const AppProvider = (props) => {
    const initialState = {
        error: { type: null, message: null },
        stateUpdate: Math.random(),
        loader: null,
        modal: {},
        auth: false,
        result: {},
        payment: {}
    }
    const [state, dispatch] = React.useReducer(Reducer, initialState)
    dispatcher = dispatch
    appState = state
    return <AppContext.Provider value={{ state }}>{props.children}</AppContext.Provider>

}

export default AppContext