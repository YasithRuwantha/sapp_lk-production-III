import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { EstimatesComponent } from './estimates.component';
import { EstimatesRoutingModule } from './estimates-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';
@NgModule({
  declarations: [ EstimatesComponent ],
  imports: [CommonModule, EstimatesRoutingModule, NgSelect2Module, DataTablesModule, NgbModule,RouterModule],
})
export class EstimatesModule {}
