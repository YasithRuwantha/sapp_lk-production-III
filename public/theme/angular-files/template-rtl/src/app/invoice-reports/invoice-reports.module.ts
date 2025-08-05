import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { InvoiceReportsRoutingModule } from './invoice-reports-routing.module';
import { InvoiceReportsComponent } from './invoice-reports.component';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [InvoiceReportsComponent],
  imports: [
    CommonModule,
    InvoiceReportsRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
    RouterModule
  ]
})
export class InvoiceReportsModule { }
