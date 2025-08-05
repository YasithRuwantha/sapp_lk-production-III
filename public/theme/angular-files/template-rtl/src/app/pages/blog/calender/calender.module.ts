import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CalenderComponent } from './calender.component';
import { CalenderRoutingModule } from './calender-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ CalenderComponent ],
  imports: [CommonModule, CalenderRoutingModule, NgSelect2Module, NgbModule,RouterModule],
})
export class CalenderModule {}
