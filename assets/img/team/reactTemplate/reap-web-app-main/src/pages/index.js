import React, { useEffect, useContext } from 'react';
import { Route, Switch } from 'react-router-dom';
import FunctionOne from '../js/FunctionOne';
import AppContext from '../js/Context/State';
import { Pageloader } from './Components';
import Login from './Login';


const App = () => {
    const appState = useContext(AppContext).state;
    useEffect(() => {
        // FunctionOne.confirmLogin()
    }, [])
    return (
        // appState.auth === true ?
        <Switch>
            <Route exact path="/" component={Login} />
            <Route exact path="/dashboard" component={Login} />
            <Route exact path={['/profile', '/profile/:id']} component={Login} />

        </Switch>
        // : <Pageloader />
    )
};



export default App;