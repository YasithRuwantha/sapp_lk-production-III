import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DataTablesModule } from 'angular-datatables';
import { CustomersComponent } from './customers.component';
import { CustomersRoutingModule } from './customers-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ CustomersComponent ],
  imports: [CommonModule, CustomersRoutingModule, DataTablesModule,RouterModule],
})
export class CustomersModule {}
