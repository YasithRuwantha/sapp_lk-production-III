import { Component, OnInit, TemplateRef } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import { Event, Router, NavigationStart } from '@angular/router';
import { Location } from '@angular/common';

@Component({
  selector: 'app-add-customer',
  templateUrl: './add-customer.component.html',
  styleUrls: ['./add-customer.component.css']
})
export class AddCustomerComponent implements OnInit {
  url;
  page = 'Add Customer';
  constructor(public router: Router, location: Location, public commonService: CommonServiceService) { 
    router.events.subscribe((event: Event) => {
      if (event instanceof NavigationStart) {
        if(event.url === '/edit-customer') {
          this.page = 'Edit Customer';
        } else {
          this.page = 'Add Customers';
        }
      }
    });
    this.url = location.path();
    if(this.url === '/edit-customer') {
      this.page = 'Edit Customer';
    } else {
      this.page = 'Add Customers';
    }
  }

  ngOnInit(): void {
  }
  
}
