import {createRouter, createWebHistory} from 'vue-router';
import Dashboard from '../components/Dashboard'
import Customers from '../components/Customers'
import AddCustomer from '../components/AddCustomer'
import EditCustomer from '../components/EditCustomer'
import CustomerProfile from '../components/CustomerProfile'
import Estimates from '../components/Estimates'
import AddEstimate from '../components/AddEstimate'
import EditEstimate from '../components/EditEstimate'
import ViewEstimate from '../components/ViewEstimate'
import Invoices from '../components/Invoices'
import AddInvoice from '../components/AddInvoice'
import EditInvoice from '../components/EditInvoice'
import ViewInvoice from '../components/ViewInvoice'
import Payments from '../components/Payments'
import AddPayment from '../components/AddPayment'
import Expenses from '../components/Expenses'
import AddExpense from '../components/AddExpense'
import EditExpense from '../components/EditExpense'
import Settings from '../components/Settings'
import Preferences from '../components/Preferences'
import TaxTypes from '../components/TaxTypes'
import ExpenseCategory from '../components/ExpenseCategory'
import Notifications from '../components/Notifications'
import ChangePassword from '../components/ChangePassword'
import DeleteAccount from '../components/DeleteAccount'
import Chat from '../components/Chat'
import Inbox from '../components/Inbox'
import Calendar from '../components/Calendar'
import Register from '../components/Register'
import Login from '../components/Login'
import ForgotPassword from '../components/ForgotPassword'
import LockScreen from '../components/LockScreen'
import Error404 from '../components/404'
import Error500 from '../components/500'
import Users from '../components/Users'
import BlankPage from '../components/BlankPage'
import VectorMaps from '../components/VectorMaps'
import Components from '../components/Components'
import FormBasicInputs from '../components/FormBasicInputs'
import FormInputGroups from '../components/FormInputGroups'
import HorizontalForm from '../components/HorizontalForm'
import VerticalForm from '../components/VerticalForm'
import FormMask from '../components/FormMask'
import FormValidation from '../components/FormValidation'
import BasicTables from '../components/BasicTables'
import DataTable from '../components/DataTable'
import Expensesreport from '../components/Expensesreport'
import Profitlossreport from '../components/Profitlossreport'
import Salesreport from '../components/Salesreport'
import Taxsreport from '../components/Taxsreport'
const routes = [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard
    },
    {
      path: '/index',
      name: 'index-page',
      component: Dashboard
    },
    {
      path: '/customers',
      name: 'customers',
      component: Customers
    },
    {
      path: '/add-customer',
      name: 'add-customer',
      component: AddCustomer
    },
    {
      path: '/edit-customer',
      name: 'edit-customer',
      component: EditCustomer
    },
    {
      path: '/customer/profile',
      name: 'customer-profile',
      component: CustomerProfile
    },
    {
      path: '/estimates',
      name: 'estimates',
      component: Estimates
    },
    {
      path: '/add-estimate',
      name: 'add-estimate',
      component: AddEstimate
    },
    {
      path: '/edit-estimate',
      name: 'edit-estimate',
      component: EditEstimate
    },
    {
      path: '/view-estimate',
      name: 'view-estimate',
      component: ViewEstimate
    },
    {
      path: '/invoices',
      name: 'invoices',
      component: Invoices
    },
    {
      path: '/add-invoice',
      name: 'add-invoice',
      component: AddInvoice
    },
    {
      path: '/edit-invoice',
      name: 'edit-invoice',
      component: EditInvoice
    },
    {
      path: '/view-invoice',
      name: 'view-invoice',
      component: ViewInvoice
    },
    {
      path: '/payments',
      name: 'payments',
      component: Payments
    },
    {
      path: '/add-payment',
      name: 'add-payment',
      component: AddPayment
    },
    {
      path: '/expenses',
      name: 'expenses',
      component: Expenses
    },
    {
      path: '/add-expense',
      name: 'add-expense',
      component: AddExpense
    },
    {
      path: '/edit-expense',
      name: 'edit-expense',
      component: EditExpense
    },
    {
      path: '/settings',
      name: 'settings',
      component: Settings
    },
    {
      path: '/preferences',
      name: 'preferences',
      component: Preferences
    },
    {
      path: '/tax-types',
      name: 'tax-types',
      component: TaxTypes
    },
    {
      path: '/expense-category',
      name: 'expense-category',
      component: ExpenseCategory
    },
    {
      path: '/notifications',
      name: 'notifications',
      component: Notifications
    },
    {
      path: '/change-password',
      name: 'change-password',
      component: ChangePassword
    },
    {
      path: '/delete-account',
      name: 'delete-account',
      component: DeleteAccount
    },
    {
      path: '/chat',
      name: 'chat',
      component: Chat
    },
    {
      path: '/inbox',
      name: 'inbox',
      component: Inbox
    },
    {
      path: '/calendar',
      name: 'calendar',
      component: Calendar
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/forgot-password',
      name: 'forgot-password',
      component: ForgotPassword
    },
    {
      path: '/lock-screen',
      name: 'lock-screen',
      component: LockScreen
    },
    {
      path: '/404',
      name: 'error-404',
      component: Error404
    },
    {
      path: '/500',
      name: 'error-500',
      component: Error500
    },
    {
      path: '/users',
      name: 'users',
      component: Users
    },
    {
      path: '/blank-page',
      name: 'blank-page',
      component: BlankPage
    },
    {
      path: '/vector-maps',
      name: 'vector-maps',
      component: VectorMaps
    },
    {
      path: '/components',
      name: 'components',
      component: Components
    },
    {
      path: '/form-basic-inputs',
      name: 'form-basic-inputs',
      component: FormBasicInputs
    },
    {
      path: '/form-input-groups',
      name: 'form-input-groups',
      component: FormInputGroups
    },
    {
      path: '/horizontal-form',
      name: 'horizontal-form',
      component: HorizontalForm
    },
    {
      path: '/vertical-form',
      name: 'vertical-form',
      component: VerticalForm
    },
    {
      path: '/form-mask',
      name: 'form-mask',
      component: FormMask
    },
    {
      path: '/form-validation',
      name: 'form-validation',
      component: FormValidation
    },
    {
      path: '/basic-tables',
      name: 'basic-tables',
      component: BasicTables
    },
    {
      path: '/datatables',
      name: 'datatables',
      component: DataTable
    },
    {
      path: '/expenses-report',
      name: 'expenses-report',
      component: Expensesreport
    },
    {
      path: '/profit-loss-report',
      name: 'profit-loss-report',
      component: Profitlossreport
    },
    {
      path: '/sales-report',
      name: 'sales-report',
      component: Salesreport
    },
    {
      path: '/taxs-report',
      name: 'taxs-report',
      component: Taxsreport
    },
  ];
export const router = createRouter({
    history: createWebHistory('vuejs/template-rtl'),
    linkActiveClass: 'active',
    routes
});