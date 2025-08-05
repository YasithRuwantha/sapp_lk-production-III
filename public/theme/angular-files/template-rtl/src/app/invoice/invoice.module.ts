import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { InvoiceComponent } from './invoice.component';
import { InvoiceRoutingModule } from './invoice-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ InvoiceComponent ],
  imports: [
    CommonModule,
    InvoiceRoutingModule,
    DataTablesModule,
    RouterModule
  ]
})
export class InvoiceModule { }
