import React from 'react';
import ReactDOM from 'react-dom';

import AppRouter from './approuter';

//Jquery

window.$ = window.jQuery = require("jquery");

//Datatable Modules
import DataTable from 'datatables.net';
import Datatable4 from 'datatables.net-bs4'

//fontawesome
import './assets/css/bootstrap.rtl.min.css';
import './assets/plugins/fontawesome/css/all.css';
import './assets/plugins/fontawesome/css/all.min.css';
import './assets/plugins/fontawesome/css/fontawesome.min.css';
import './assets/plugins/datatables/datatables.min.css';
import './assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css';
import './assets/plugins/select2/css/select2.min.css';
import 'react-select2-wrapper/css/select2.css';
import "react-datepicker/dist/react-datepicker.css";

//style
import './assets/js/jquery-3.6.0.min.js';
import './assets/plugins/slimscroll/jquery.slimscroll.min.js';
import './assets/plugins/select2/js/select2.min.js';
import './assets/js/bootstrap.min.js';
import './assets/css/style.css';

ReactDOM.render(<AppRouter/>, document.getElementById('root'));

if (module.hot) { // enables hot module replacement if plugin is installed
 module.hot.accept();
}