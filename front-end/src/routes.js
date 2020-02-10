import React from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';

import Dashboard from './pages/Dashboard';
import Empresa from './pages/Empresa';
import Socio from './pages/Socio';

export default function Routes() {
    return (
        <BrowserRouter>
            <Switch>
                <Route path="/" exact component={Dashboard} />
                <Route path="/empresa" exact component={Empresa} />
                <Route path="/socio" exact component={Socio} />
            </Switch>
        </BrowserRouter>
    );
}
