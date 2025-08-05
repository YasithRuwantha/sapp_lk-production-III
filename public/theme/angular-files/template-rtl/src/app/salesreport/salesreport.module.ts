import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { DataTablesModule } from 'angular-datatables';

import { SalesreportRoutingModule } from './salesreport-routing.module';
import { SalesreportComponent } from './salesreport.component';


@NgModule({
  declarations: [
    SalesreportComponent
  ],
  imports: [
    CommonModule,
    SalesreportRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
  ]
})
export class SalesreportModule { }
