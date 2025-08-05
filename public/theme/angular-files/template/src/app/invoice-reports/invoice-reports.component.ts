import {
  AfterViewInit,
  Component,
  OnDestroy,
  OnInit,
  ViewChild,
  TemplateRef,
} from '@angular/core';
import { CommonServiceService } from '../common-service.service';
import * as $ from 'jquery';

@Component({
  selector: 'app-invoice-reports',
  templateUrl: './invoice-reports.component.html',
  styleUrls: ['./invoice-reports.component.css'],
})
export class InvoiceReportsComponent implements OnInit {
  invoices: any = [];
  errorMessage: string;
  dtOptions: DataTables.Settings = {};

  constructor(
    public commonService: CommonServiceService
  ) {}

  ngOnInit(): void {
    this.getInvoices();
  }

  getInvoices() {
    this.commonService.getInvoices().subscribe(
      (res) => {
        this.invoices = res;
      },
      (error) => (this.errorMessage = <any>error)
    );
  }
}
