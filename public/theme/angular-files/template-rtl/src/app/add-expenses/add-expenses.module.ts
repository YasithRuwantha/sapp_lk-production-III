import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { AddExpensesComponent } from './add-expenses.component';
import { AddExpensesRoutingModule } from './add-expenses-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ AddExpensesComponent ],
  imports: [
    CommonModule,
    AddExpensesRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    RouterModule,
    NgbModule
  ]
})
export class AddExpensesModule { }
