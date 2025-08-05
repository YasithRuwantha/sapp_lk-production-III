import { createApp } from 'vue';
import { router } from './router';
import './assets/css/bootstrap.rtl.min.css'
import './assets/plugins/fontawesome/css/fontawesome.min.css'
import './assets/plugins/fontawesome/css/all.min.css'
import App from "./App.vue";
import Header from './components/layouts/Header'
import SideBar from './components/layouts/Sidebar'
import SettingsSidebar from './components/layouts/SettingsSidebar'
import SlideUpDown from 'vue3-slide-up-down'
import jquery from 'jquery'; 
window.$ = jquery
import './assets/plugins/select2/css/select2.min.css'
import './assets/plugins/select2/js/select2.min.js'
import './assets/css/bootstrap-datetimepicker.min.css'
import './assets/js/bootstrap-datetimepicker.min.js'
import './assets/plugins/fullcalendar/fullcalendar.min.css'
import './assets/js/jquery-ui.min.js'
import './assets/plugins/fullcalendar/fullcalendar.min.js'
import './assets/css/style.css'
import './assets/js/bootstrap.bundle.min.js'
import './assets/css/bootstrap4.min.css'
import './assets/css/dataTables.bootstrap4.min.css'
import './assets/css/jquery.dataTables.min.js'
import './assets/css/dataTables.bootstrap4.min.js'
import Raphael from 'raphael/raphael'
global.Raphael = Raphael
const app = createApp(App)
/** Layouts **/
app.component('layout-header', Header);
app.component('layout-sidebar', SideBar);
app.component('layout-settings-sidebar', SettingsSidebar);
app.component('slide-up-down', SlideUpDown)
app.use(router)
.mount('#app');