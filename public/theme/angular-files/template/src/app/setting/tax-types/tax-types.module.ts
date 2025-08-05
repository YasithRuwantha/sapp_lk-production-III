import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TaxTypesComponent } from './tax-types.component';
import { TaxTypesRoutingModule } from './tax-types-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ TaxTypesComponent ],
  imports: [CommonModule, TaxTypesRoutingModule, NgSelect2Module,RouterModule],
})
export class TaxTypesModule {}
