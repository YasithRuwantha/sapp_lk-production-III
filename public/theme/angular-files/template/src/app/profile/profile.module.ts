import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { ProfileComponent } from './profile.component';
import { ProfileRoutingModule } from './profile-routing.module';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [ ProfileComponent ],
  imports: [CommonModule, ProfileRoutingModule, NgbModule,RouterModule],
})
export class ProfileModule {}
