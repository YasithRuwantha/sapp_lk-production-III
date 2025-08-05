import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';
@Component({
  selector: 'app-expenses',
  templateUrl: './expenses.component.html',
  styleUrls: ['./expenses.component.css'],
})

export class ExpensesComponent implements OnInit {
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
