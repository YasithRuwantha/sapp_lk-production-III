import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-view-estimate',
  templateUrl: './view-estimate.component.html',
  styleUrls: ['./view-estimate.component.css'],
})
export class ViewEstimateComponent implements OnInit {
  estimates: any = [];
  errorMessage: string;

  constructor(public commonService: CommonServiceService) {}

  ngOnInit(): void {
    this.getEstimates();
  }

  getEstimates() {
    this.commonService.getEstimates().subscribe(
      (res) => {
        this.estimates = res;
        // $(function () {
        //   $('table').DataTable();
        // });
      },
      (error) => (this.errorMessage = <any>error)
    );
  }
}
