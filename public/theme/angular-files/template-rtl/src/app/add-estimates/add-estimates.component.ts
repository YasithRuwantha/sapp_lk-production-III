import { Component, OnInit, TemplateRef } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import { Event, Router, NavigationStart } from '@angular/router';
import { Location } from '@angular/common';
// import * as $ from 'jquery';
declare const $: any;

@Component({
  selector: 'app-add-estimates',
  templateUrl: './add-estimates.component.html',
  styleUrls: ['./add-estimates.component.css']
})
export class AddEstimatesComponent implements OnInit {
  url;
  page = 'Add Estimate';
  constructor(public router: Router, location: Location, public commonService: CommonServiceService) { 
    router.events.subscribe((event: Event) => {
      if (event instanceof NavigationStart) {
        if(event.url === '/edit-estimate') {
          this.page = 'Edit Estimate';
        } else {
          this.page = 'Add Estimate';
        }
      }
    });
    this.url = location.path();
    if(this.url === '/edit-estimate') {
      this.page = 'Edit Estimate';
    } else {
      this.page = 'Add Estimate';
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

  deleteModal(template: TemplateRef<any>, special) {
  }
  
}
