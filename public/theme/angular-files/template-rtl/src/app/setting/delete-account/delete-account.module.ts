import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgSelect2Module } from 'ng-select2';
import { DeleteAccountComponent } from './delete-account.component';
import { DeleteAccountRoutingModule } from './delete-account-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ DeleteAccountComponent ],
  imports: [NgSelect2Module, CommonModule, DeleteAccountRoutingModule,RouterModule],
})
export class DeleteAccountModule {}
