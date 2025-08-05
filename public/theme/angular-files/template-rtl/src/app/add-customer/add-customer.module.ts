import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { AddCustomerComponent } from './add-customer.component';
import { AddCustomerRoutingModule } from './add-customer-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ AddCustomerComponent ],
  imports: [
    CommonModule,
    AddCustomerRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    RouterModule
  ]
})
export class AddCustomerModule { }
