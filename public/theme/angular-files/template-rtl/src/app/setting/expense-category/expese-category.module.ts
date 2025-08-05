import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ExpeseCategoryComponent } from './expese-category.component';
import { ExpeseCategoryRoutingModule } from './expese-category-routing.module';
import { NgSelect2Module } from 'ng-select2';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ ExpeseCategoryComponent ],
  imports: [
    CommonModule,
    FormsModule,
    ExpeseCategoryRoutingModule,
    NgSelect2Module,
    RouterModule
  ]
})

export class ExpenseCategoryModule { }
