import { Component, OnInit, TemplateRef } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import { Event, Router, NavigationStart } from '@angular/router';
import { Location } from '@angular/common';
declare const $: any;

@Component({
  selector: 'app-add-expenses',
  templateUrl: './add-expenses.component.html',
  styleUrls: ['./add-expenses.component.css']
})
export class AddExpensesComponent implements OnInit {
  url;
  page = 'Add Expense';
  constructor(public router: Router, location: Location, public commonService: CommonServiceService) { 
    router.events.subscribe((event: Event) => {
      if (event instanceof NavigationStart) {
        if(event.url === '/edit-expenses') {
          this.page = 'Edit Expense';
        } else {
          this.page = 'Add Expense';
        }
      }
    });
    this.url = location.path();
    if(this.url === '/edit-expenses') {
      this.page = 'Edit Expense';
    } else {
      this.page = 'Add Expense';
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
