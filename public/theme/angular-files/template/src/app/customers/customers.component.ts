import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-customers',
  templateUrl: './customers.component.html',
  styleUrls: ['./customers.component.css'],
})
export class CustomersComponent implements OnInit {
  customers: any = [];
  errorMessage: string;

  constructor(public commonService: CommonServiceService) {}

  ngOnInit(): void {
    this.getCustomers();
  }

  getCustomers() {
    this.commonService.getCustomers().subscribe(
      (res) => {
        this.customers = res;
      },
      (error) => (this.errorMessage = <any>error)
    );
  }

  filter() {
    
  }
}
