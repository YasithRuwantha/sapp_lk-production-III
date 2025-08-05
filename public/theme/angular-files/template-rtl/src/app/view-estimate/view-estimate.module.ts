import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { NgSelect2Module } from 'ng-select2';
import { ViewEstimateComponent } from './view-estimate.component';
import { ViewEstimateRoutingModule } from './view-estimate-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ ViewEstimateComponent ],
  imports: [CommonModule, ViewEstimateRoutingModule, NgSelect2Module,RouterModule],
})
export class ViewEstimateModule {}
