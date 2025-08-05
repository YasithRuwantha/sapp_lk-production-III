import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-payments',
  templateUrl: './payments.component.html',
  styleUrls: ['./payments.component.css']
})
export class PaymentsComponent implements OnInit {
  payments: any = [];
  errorMessage: string;

  constructor(public commonService: CommonServiceService) { }

  ngOnInit(): void {
    this.getPayments();
  }

  getPayments() {
    this.commonService.getPayments().subscribe(
      (res) => {
        this.payments = res;
      },
      (error) => (this.errorMessage = <any>error)
    );
  }

}
