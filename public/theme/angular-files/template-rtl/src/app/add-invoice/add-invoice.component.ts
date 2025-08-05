import { Component, OnInit, TemplateRef } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import { Event, Router, NavigationStart } from '@angular/router';
import { Location } from '@angular/common';
declare const $: any;

@Component({
  selector: 'app-add-invoice',
  templateUrl: './add-invoice.component.html',
  styleUrls: ['./add-invoice.component.css']
})
export class AddInvoiceComponent implements OnInit {
  url;
  page = 'Add Invoice';
  constructor(public router: Router, location: Location, public commonService: CommonServiceService) { 
    router.events.subscribe((event: Event) => {
      if (event instanceof NavigationStart) {
        if(event.url === '/edit-invoice') {
          this.page = 'Edit Invoice';
        } else {
          this.page = 'Add Invoice';
        }
      }
    });
    this.url = location.path();
    if(this.url === '/edit-invoice') {
      this.page = 'Edit Invoice';
    } else {
      this.page = 'Add Invoice';
    }
  }

  ngOnInit() {
      // Datetimepicker
  
  if($('.datetimepicker').length > 0 ){
    $('.datetimepicker').datetimepicker({
      format: 'DD-MM-YYYY',
      icons: {
        up: "fas fa-angle-up",
        down: "fas fa-angle-down",
        next: 'fas fa-angle-right',
        previous: 'fas fa-angle-left'
      }
    });
  }
  }
  
}
