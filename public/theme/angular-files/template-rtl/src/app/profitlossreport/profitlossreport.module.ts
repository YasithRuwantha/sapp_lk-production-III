import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { DataTablesModule } from 'angular-datatables';

import { ProfitlossreportRoutingModule } from './profitlossreport-routing.module';
import { ProfitlossreportComponent } from './profitlossreport.component';

@NgModule({
  declarations: [
    ProfitlossreportComponent
  ],
  imports: [
    CommonModule,
    ProfitlossreportRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
  ]
})
export class ProfitlossreportModule { }
