import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdminDataTableComponent } from './admin-data-table.component';
import { AdminDataTableRoutingModule } from './admin-data-table-routing.module';
import { DataTablesModule } from 'angular-datatables';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ AdminDataTableComponent ],
  imports: [
    CommonModule,
    AdminDataTableRoutingModule,
    DataTablesModule,
    RouterModule
  ]
})
export class AdminDataTableModule { }
