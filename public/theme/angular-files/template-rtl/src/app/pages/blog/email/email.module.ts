import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgSelect2Module } from 'ng-select2';
import { EmailComponent } from './email.component';
import { EmailRoutingModule } from './email-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ EmailComponent ],
  imports: [CommonModule, EmailRoutingModule, NgSelect2Module,RouterModule],
})
export class EmailModule {}
