import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { DataTablesModule } from 'angular-datatables';
import { ExpensesreportRoutingModule } from './expensesreport-routing.module';
import { ExpensesreportComponent } from './expensesreport.component';

@NgModule({
  declarations: [
    ExpensesreportComponent
  ],
  imports: [
    CommonModule,
    ExpensesreportRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
  ]
})
export class ExpensesreportModule { }
