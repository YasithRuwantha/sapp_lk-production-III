import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-taxsreport',
  templateUrl: './taxsreport.component.html',
  styleUrls: ['./taxsreport.component.css']
})
export class TaxsreportComponent implements OnInit {

  
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
