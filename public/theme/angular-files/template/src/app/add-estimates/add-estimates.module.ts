import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { AddEstimatesComponent } from './add-estimates.component';
import { AddstimatesRoutingModule } from './add-estimates-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ AddEstimatesComponent ],
  imports: [
    CommonModule,
    AddstimatesRoutingModule,
    DataTablesModule,
    NgSelect2Module,
    NgbModule,
    RouterModule
  ]
})
export class AddEstimatesModule { }
