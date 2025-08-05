import { Component, OnInit } from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-estimates',
  templateUrl: './estimates.component.html',
  styleUrls: ['./estimates.component.css'],
})
export class EstimatesComponent implements OnInit {
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
      },
      (error) => (this.errorMessage = <any>error)
    );
  }
}
