import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { DataTablesModule } from 'angular-datatables';

import { TaxsreportRoutingModule } from './taxsreport-routing.module';
import { TaxsreportComponent } from './taxsreport.component';


@NgModule({
  declarations: [
    TaxsreportComponent
  ],
  imports: [
    CommonModule,
    TaxsreportRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
  ]
})
export class TaxsreportModule { }
