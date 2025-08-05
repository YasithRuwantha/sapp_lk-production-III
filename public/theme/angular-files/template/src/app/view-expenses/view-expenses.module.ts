import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { NgSelect2Module } from 'ng-select2';
import { ViewExpensesComponent } from './view-expenses.component';
import { ViewExpensesRoutingModule } from './view-expenses-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ ViewExpensesComponent ],
  imports: [
    CommonModule,
    DataTablesModule,
    NgSelect2Module,
    ViewExpensesRoutingModule,
    RouterModule
  ]
})
export class ExpensesModule { }
