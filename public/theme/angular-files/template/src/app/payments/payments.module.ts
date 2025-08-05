import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { DataTablesModule } from 'angular-datatables';
import { PaymentsComponent } from './payments.component';
import { PaymentsRoutingModule } from './payments-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ PaymentsComponent ],
  imports: [
    CommonModule,
    PaymentsRoutingModule,
    FormsModule,
    DataTablesModule,
    NgSelect2Module,
    RouterModule
  ]
})
export class PaymentsModule { }
