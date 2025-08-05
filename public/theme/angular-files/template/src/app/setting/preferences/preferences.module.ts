import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ModalModule } from 'ngx-bootstrap/modal';
import { PreferencesRoutingModule } from './preferences-routing.module';
import { PreferencesComponent } from './preferences.component';
import { NgSelect2Module } from 'ng-select2';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ PreferencesComponent ],
  imports: [
    CommonModule,
    PreferencesRoutingModule,
    NgSelect2Module,
    ModalModule.forRoot(),
    RouterModule
  ]
})

export class PreferencesModule { }
