import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { ViewInvoiceComponent } from './view-invoice.component';
import { ViewInvoiceRoutingModule } from './view-invoice-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ ViewInvoiceComponent ],
  imports: [
    CommonModule,
    ViewInvoiceRoutingModule,
    DataTablesModule,
    RouterModule
  ]
})
export class ViewInvoiceModule { }
