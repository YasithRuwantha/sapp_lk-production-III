import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AppointmentsRoutingModule } from './expenses-routing.module';
import { DataTablesModule } from 'angular-datatables';
import { ExpensesComponent } from './expenses.component';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';
@NgModule({
  declarations: [ ExpensesComponent ],
  imports: [
    CommonModule,
    AppointmentsRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
    RouterModule
  ]
})
export class ExpensesModule { }
