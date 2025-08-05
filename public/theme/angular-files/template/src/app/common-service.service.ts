import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { BehaviorSubject } from 'rxjs';
import { map } from 'rxjs/operators';

@Injectable({
  providedIn: 'root',
})
export class CommonServiceService {

  messages: '';
  SERVER_URL: string = 'http://localhost:8080/api/';
  message: BehaviorSubject<String>;
  constructor(public http: HttpClient) {
    this.message = new BehaviorSubject(this.messages);
  }

  nextmessage(data) {
    this.message.next(data);
  }


  // Kanakku services
  getCustomers() {
    return this.http.get(this.SERVER_URL + 'customers');
  }

  getEstimates() {
    return this.http.get(this.SERVER_URL + 'estimates');
  }

  getInvoices() {
    return this.http.get(this.SERVER_URL + 'invoices');
  }

  getPayments() {
    return this.http.get(this.SERVER_URL + 'payments');
  }

  getExpenses() {
    return this.http.get(this.SERVER_URL + 'expenses');
  }
}
