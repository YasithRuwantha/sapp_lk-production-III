import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-view-expenses',
  templateUrl: './view-expenses.component.html',
  styleUrls: ['./view-expenses.component.css'],
})
export class ViewExpensesComponent implements OnInit {
  expeses: any = [];
  errorMessage: string;
  constructor(public commonService: CommonServiceService) {}

  ngOnInit(): void {    
    this.getExpenses();
  }
  getExpenses() {
    this.commonService.getExpenses().subscribe((res) => {
      this.expeses = res;
    });
  }

}
