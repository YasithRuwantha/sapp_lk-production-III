import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { AddPaymentsComponent } from './add-payments.component';
import { AddPaymentsRoutingModule } from './add-payments-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';
@NgModule({
  declarations: [ AddPaymentsComponent ],
  imports: [
    CommonModule,
    AddPaymentsRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    RouterModule,
    NgbModule,
  ]
})
export class AddPaymentsModule { }
