import { NgModule } from '@angular/core';
import { Routes, RouterModule, PreloadAllModules } from '@angular/router';

const routes: Routes = [
  { path: '', redirectTo: 'index', pathMatch: 'full' },  
  {
    path: 'index',
    loadChildren: () =>
      import('./dashboard/dashboard.module').then((m) => m.DashboardModule),
  },
  {
    path: 'forgot-pass',
    loadChildren: () =>
      import(
        './pages/authendication/forgot-password/forgot-password.module'
      ).then((m) => m.ForgotPasswordModule),
  },
  {
    path: 'login-form',
    loadChildren: () =>
      import('./pages/authendication/login/login.module').then(
        (m) => m.LoginModule
      ),
  },
 
  {
    path: 'chat',
    loadChildren: () =>
      import('./pages/blog/chat/chat.module').then((m) => m.ChatModule),
  },
  {
    path: 'calender',
    loadChildren: () =>
      import('./pages/blog/calender/calender.module').then(
        (m) => m.CalenderModule
      ),
  },
  {
    path: 'email',
    loadChildren: () =>
      import('./pages/blog/email/email.module').then(
        (m) => m.EmailModule
      ),
  },
  {
    path: 'profile',
    loadChildren: () =>
      import('./profile/profile.module').then(
        (m) => m.ProfileModule
      ),
  },
  {
    path: 'lock-screen',
    loadChildren: () =>
      import('./pages/authendication/lock-screen/lock-screen.module').then(
        (m) => m.LockScreenModule
      ),
  },
  {
    path: 'register',
    loadChildren: () =>
      import('./pages/authendication/regiser/register.module').then(
        (m) => m.RegisterModule
      ),
  },
  {
    path: 'blank-page',
    loadChildren: () =>
      import('./pages/blank-page/blank-page.module').then(
        (m) => m.BlankPageModule
      ),
  },
  {
    path: 'error-first',
    loadChildren: () =>
      import('./pages/error-pages/error-first/error-first.module').then(
        (m) => m.ErrorFirstModule
      ),
  },
  {
    path: 'error-second',
    loadChildren: () =>
      import('./pages/error-pages/error-second/error-second.module').then(
        (m) => m.ErrorSecondModule
      ),
  },
  {
    path: 'components',
    loadChildren: () =>
      import('./ui-interface/components/components.module').then(
        (m) => m.ComponentsModule
      ),
  },
  {
    path: 'basic-input',
    loadChildren: () =>
      import('./ui-interface/forms/basic-inputs/basic-inputs.module').then(
        (m) => m.BasicInputsModule
      ),
  },
  {
    path: 'form-validation',
    loadChildren: () =>
      import(
        './ui-interface/forms/form-validation/form-validation.module'
      ).then((m) => m.FormValidationModule),
  },
  {
    path: 'horizondal-form',
    loadChildren: () =>
      import(
        './ui-interface/forms/horizondal-form/horizondal-form.module'
      ).then((m) => m.HorizondalFormModule),
  },
  {
    path: 'input-groups',
    loadChildren: () =>
      import('./ui-interface/forms/input-groups/input-groups.module').then(
        (m) => m.InputGroupsModule
      ),
  },
  {
    path: 'vertical-form',
    loadChildren: () =>
      import(
        './ui-interface/forms/vertical-form/vertical-form.module'
      ).then((m) => m.VerticalFormModule),
  },
  {
    path: 'form-mask',
    loadChildren: () =>
      import('./ui-interface/forms/form-mask/form-mask.module').then(
        (m) => m.FormMaskModule
      ),
  },
  {
    path: 'basic-tables',
    loadChildren: () =>
      import('./ui-interface/tables/basic-tables/basic-tables.module').then(
        (m) => m.BasicTablesModule
      ),
  },
  {
    path: 'admin-data-table',
    loadChildren: () =>
      import(
        './ui-interface/tables/admin-data-table/admin-data-table.module'
      ).then((m) => m.AdminDataTableModule),
  },
  {
    path: 'expenses',
    loadChildren: () =>
      import('./expenses/expenses.module').then(
        (m) => m.ExpensesModule
      ),
  },
  {
    path: 'maps-vector',
    loadChildren: () =>
      import('./mapvector/mapvector.module').then(
        (m) => m.MapvectorModule
      ),
  },
  {
    path: 'expenses-report',
    loadChildren: () =>
      import('./expensesreport/expensesreport.module').then(
        (m) => m.ExpensesreportModule
      ),
  },
  {
    path: 'profit-loss-report',
    loadChildren: () =>
      import('./profitlossreport/profitlossreport.module').then(
        (m) => m.ProfitlossreportModule
      ),
  },
  {
    path: 'sales-report',
    loadChildren: () =>
      import('./salesreport/salesreport.module').then(
        (m) => m.SalesreportModule
      ),
  },
   {
    path: 'taxs-report',
    loadChildren: () =>
      import('./taxsreport/taxsreport.module').then(
        (m) => m.TaxsreportModule
      ),
  },
  {
    path: 'add-expenses',
    loadChildren: () =>
      import('./add-expenses/add-expenses.module').then((m) => m.AddExpensesModule),
  },
  {
    path: 'edit-expenses',
    loadChildren: () =>
    import('./add-expenses/add-expenses.module').then((m) => m.AddExpensesModule),
  },
  {
    path: 'payments',
    loadChildren: () =>
      import('./payments/payments.module').then(
        (m) => m.PaymentsModule
      ),
  },
  {
    path: 'add-payment',
    loadChildren: () =>
      import('./add-payments/add-payments.module').then((m) => m.AddPaymentsModule),
  },
  {
    path: 'customers',
    loadChildren: () =>
      import('./customers/customers.module').then((m) => m.CustomersModule),
  },
  {
    path: 'users',
    loadChildren: () =>
      import('./users/users.module').then((m) => m.UsersModule),
  },
  {
    path: 'add-customer',
    loadChildren: () =>
      import('./add-customer/add-customer.module').then((m) => m.AddCustomerModule),
  },
  {
    path: 'edit-customer',
    loadChildren: () =>
      import('./add-customer/add-customer.module').then((m) => m.AddCustomerModule),
  },
  {
    path: 'estimates',
    loadChildren: () =>
      import('./estimates/estimates.module').then((m) => m.EstimatesModule),
  },
  {
    path: 'add-estimate',
    loadChildren: () =>
      import('./add-estimates/add-estimates.module').then((m) => m.AddEstimatesModule),
  },
  {
    path: 'edit-estimate',
    loadChildren: () =>
    import('./add-estimates/add-estimates.module').then((m) => m.AddEstimatesModule),
  },
  {
    path: 'view-estimate',
    loadChildren: () =>
    import('./view-estimate/view-estimate.module').then((m) => m.ViewEstimateModule),
  },
  {
    path: 'transactions',
    loadChildren: () =>
      import('./transactions/transactions.module').then(
        (m) => m.TransactionsModule
      ),
  },
  {
    path: 'invoice-reports',
    loadChildren: () =>
      import('./invoice-reports/invoice-reports.module').then(
        (m) => m.InvoiceReportsModule
      ),
  },
  {
    path: 'view-invoice',
    loadChildren: () =>
      import('./view-invoice/view-invoice.module').then(
        (m) => m.ViewInvoiceModule
      ),
  },
  {
    path: 'add-invoice',
    loadChildren: () =>
      import('./add-invoice/add-invoice.module').then((m) => m.AddInvoiceModule),
  },
  {
    path: 'edit-invoice',
    loadChildren: () =>
      import('./add-invoice/add-invoice.module').then((m) => m.AddInvoiceModule),
  },
  {
    path: 'setting',
    loadChildren: () =>
      import('./setting/setting.module').then((m) => m.SettingModule),
  },
];

@NgModule({
  imports: [
    RouterModule.forRoot(routes, {
    onSameUrlNavigation: 'reload',
    preloadingStrategy: PreloadAllModules,
    relativeLinkResolution: 'legacy'
}),
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
