import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.css'],
})
export class UsersComponent implements OnInit {
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
}
