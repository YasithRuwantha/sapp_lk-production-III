import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HorizondalFormRoutingModule } from './horizondal-form-routing.module';
import { RouterModule } from '@angular/router';
import { NgSelect2Module } from 'ng-select2';
import { HorizondalFormComponent } from './horizondal-form.component';

@NgModule({
  declarations: [HorizondalFormComponent],
  imports: [
    CommonModule,
    HorizondalFormRoutingModule,
    RouterModule,
    NgSelect2Module
  ]
})
export class HorizondalFormModule { }
