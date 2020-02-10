import React from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';

import Dashboard from './pages/Dashboard';
import Empresa from './pages/Empresa';
import Socio from './pages/Socio';
import Detalhes from './pages/Detalhes';

export default function Routes() {
    return (
        <BrowserRouter>
            <Switch>
                <Route path="/" exact component={Dashboard} />
                <Route path="/empresa" exact component={Empresa} />
                <Route path="/socio" exact component={Socio} />
                <Route path="/detalhes" exact component={Detalhes} />
            </Switch>
        </BrowserRouter>
    );
}
