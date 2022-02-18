import React, { useEffect } from 'react';
import { Router, Route, Switch } from 'react-router-dom';
import { AppProvider } from '../src/js/Context/State';
import '../src/App.css'
import Pages from '../src/pages'
import Apphistory from '../src/js/Context/Apphistory';
import Login from './pages/Login';
import Register from './pages/Register';
import Reset from './pages/Reset';
import Newpassword from './pages/Newpassword';
import Confirmaccount from './pages/Confirmaccount';




const App = () => (
  <AppProvider>
    <Router history={Apphistory}>
      <Switch>
        <Route exact path='/login' component={Login} />
        <Route exact path={['/register', '/register/:id']} component={Register} />
        <Route exact path='/reset' component={Reset} />
        <Route exact path={['/changepwd', '/changepwd/:id']} component={Newpassword} />
        <Route exact path={['/confirm', '/confirm/:id']} component={Confirmaccount} />
        <Route>
          <Pages />
        </Route>
      </Switch>

    </Router>
  </AppProvider>
)
  ;



export default App;