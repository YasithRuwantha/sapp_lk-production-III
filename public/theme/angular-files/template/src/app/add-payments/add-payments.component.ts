import { Component, OnInit, TemplateRef } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
// import * as $ from 'jquery';
declare const $: any;

@Component({
  selector: 'app-add-payments',
  templateUrl: './add-payments.component.html',
  styleUrls: ['./add-payments.component.css']
})
export class AddPaymentsComponent implements OnInit {

  constructor(public commonService: CommonServiceService) { }

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
