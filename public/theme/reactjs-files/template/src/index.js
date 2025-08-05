import React from 'react';
import ReactDOM from 'react-dom';

import AppRouter from './approuter';

// boostrap
import 'bootstrap/dist/css/bootstrap.min.css'
import  bootstrap from 'bootstrap';
//Jquery

window.$ = window.jQuery = require("jquery");

//Datatable Modules
import DataTable from 'datatables.net';
import Datatable4 from 'datatables.net-bs4'

//fontawesome
import './assets/plugins/fontawesome/css/all.css';
import './assets/plugins/fontawesome/css/all.min.css';
import './assets/plugins/fontawesome/css/fontawesome.min.css';
import 'react-select2-wrapper/css/select2.css';
import "react-datepicker/dist/react-datepicker.css";
import './assets/css/style.css';

//style
import './assets/plugins/slimscroll/jquery.slimscroll.min.js';
import './assets/plugins/datatables/datatables.min.css';
import './assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css';
import './assets/js/bootstrap.min.js';

ReactDOM.render(<AppRouter/>, document.getElementById('root'));

if (module.hot) { // enables hot module replacement if plugin is installed
 module.hot.accept();
}