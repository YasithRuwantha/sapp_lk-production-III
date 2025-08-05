import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { VerticalFormRoutingModule } from './vertical-form-routing.module';
import { RouterModule } from '@angular/router';
import { NgSelect2Module } from 'ng-select2';
import { VerticalFormComponent } from './vertical-form.component';

@NgModule({
  declarations: [VerticalFormComponent],
  imports: [
    CommonModule,
    VerticalFormRoutingModule,
    RouterModule,
    NgSelect2Module
  ]
})
export class VerticalFormModule { }
