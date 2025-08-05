import {
  Component,
  OnInit,
  ViewEncapsulation,
  Inject,
  AfterViewInit,
} from '@angular/core';
import {
  Event,
  NavigationStart,
  Router,
  ActivatedRoute,
  Params,
} from '@angular/router';
import { DOCUMENT } from '@angular/common';
import { CommonServiceService } from './common-service.service';
import * as Feather from 'feather-icons';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  //changeDetection: ChangeDetectionStrategy.OnPush,
  styleUrls: ['./app.component.css'],
  encapsulation: ViewEncapsulation.None,
})
export class AppComponent implements OnInit, AfterViewInit  {
  adminShow: boolean = true;
  constructor(
    @Inject(DOCUMENT) private document,
    public commonService: CommonServiceService,
    private route: ActivatedRoute,
    public Router: Router
  ) {
    Router.events.subscribe((event: Event) => {
      if (event instanceof NavigationStart) {
        if (
          event.url === '/forgot-pass' ||
          event.url === '/lock-screen' ||
          event.url === '/login-form' ||
          event.url === '/register' ||
          event.url === '/error-first' ||
          event.url === '/error-second'
        ) {
          this.adminShow = false;
        } else {
          this.adminShow = true;
        }
        // if (
        //   event.url === '/error-first' ||
        //   event.url === '/error-second'
        // ) {
        //   document.querySelector('body').classList.add('error-page');
        //   document.querySelector('body').classList.remove('mat-typography');
        // } else {
        //   document.querySelector('body').classList.remove('error-page');
        //   document.querySelector('body').classList.add('mat-typography');
        // }
      }

    });
  }
  ngOnInit(): void {
  }

  ngAfterViewInit() {
    Feather.replace();
  }
}
